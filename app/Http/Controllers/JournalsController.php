<?php

namespace App\Http\Controllers;

use App\Models\Journals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class JournalsController extends Controller
{
    public function index($current_page)
    {
        $journals = new Journals();
        $offset = ($current_page - 1) * 9;
        $data['journals'] = $journals->offset($offset)->limit(9)->get();
        $count = $journals->count();
        $data['paging'] = dataPaging($count, $current_page, 9);
        $data['current_page'] = $current_page;

        return view('pages.research', $data);
    }

    public function ajaxDataTable()
    {
        $data = Journals::select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_journal="'.$row->id_journal.'" data-title="'.$row->title.'" data-author="'.$row->author.'" 
                data-year="'.$row->year.'" data-type="'.$row->type.'" data-keyword="'.$row->keyword.'" data-file="'.$row->file.'"
                data-description="'.$row->description.'">
                <i class="fa fa-edit"></i> </button></div>
                <a href="/journals/delete/' . $row->id_journal . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteJournals($id)
    {
        $journals = Journals::find($id);
        $journals->delete();
        Storage::delete('public/journals'.$journals->file);
        return redirect()->back()->with('action', 'success');
    }

    public function addJournals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:pdf|max:10048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $journals = new Journals();
        $journals->id_journal = $request->id_journal;
        $journals->title = $request->title;
        $journals->author = $request->author;
        $journals->year = $request->year;
        $journals->type = $request->type;
        $journals->keyword = $request->keyword;
        $journals->description = $request->description;

        if($file = $request->file('file')){
            $file->storeAs('public/journals', $file->getClientOriginalName());
            $journals->file = $file->getClientOriginalName();
        }
        $journals->save();
        return redirect()->back()->with('action', 'success');
    }

    public function editJournals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:pdf|max:10048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $journals = Journals::find($request->id_journal);
        $journals->title = $request->title;
        $journals->author = $request->author;
        $journals->year = $request->year;
        $journals->type = $request->type;
        $journals->keyword = $request->keyword;
        $journals->description = $request->description;

        if($file = $request->file('file')){
            $file->storeAs('public/journals', $file->getClientOriginalName());
            $journals->file = $file->getClientOriginalName();
        }
        $journals->save();
        return redirect()->back()->with('action', 'success');
    }
}
