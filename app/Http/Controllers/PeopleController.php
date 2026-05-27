<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\PeopleJournals;
use App\Models\SelfJournals;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeopleController extends Controller
{

    public function index()
    {
        $peopleM = new People();
        $data['people'] = $peopleM->get();
        return view('pages.people', $data);
    }

    public function peopleDetail($slug)
    {
        $peopleM = new People();
        $data['people'] = $peopleM->with(['journals', 'self_journals'])->where('slug', $slug)->first();
        return view('pages.peopledetail', $data);
    }

    public function aboutPage()
    {
        $peopleM = new People();
        $data['people'] = $peopleM->get();
        return view('pages.about', $data);
    }

    public function ajaxDataTable()
    {
        $data = People::with('journals')->select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_people="'.$row->id_people.'" data-name="'.$row->name.'" data-position="'.$row->position.'" 
                data-description="'.$row->description.'" data-slug="'.$row->slug.'">
                <i class="fa fa-edit"></i> </button></div>
                <button class="open-journals btn btn-sm btn-outline-info" data-toggle="modal" data-target="#modalJournals"
                data-id_people="'.$row->id_people.'">
                <i class="fa fa-journal-whills"></i> </button></div>
                <a href="/people/delete/' . $row->id_people . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addPeople(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpg,jpeg,png|max:10048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }
        $people = new People;
        $people->name = $request->name;
        $people->slug = $request->slug;
        $people->position = $request->position;
        $people->description = $request->description;

        if($file = $request->file('file')){
            $file->storeAs('public/people', $file->hashName());
            $people->image = $file->hashName();
        }
        $people->save();

        //Add Journal
        $data = json_decode($request->journals);
        foreach($data as $row)
        {
            $people_journals = new PeopleJournals();
            $people_journals->id_people = $people->id_people;
            $people_journals->id_journal = $row->id_journal;
            $people_journals->save();
        }
        
        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function addSelfJournals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:pdf|max:10048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $journals = new SelfJournals();
        $journals->id_people = $request->id_people2;
        $journals->title = $request->title;
        $journals->author = $request->author;
        $journals->year = $request->year;
        $journals->type = $request->type;
        $journals->keyword = $request->keyword;
        $journals->description = $request->description;

        if($file = $request->file('file')){
            $file->storeAs('public/selfjournals', $file->getClientOriginalName());
            $journals->file = $file->getClientOriginalName();
        }
        $journals->save();
        return redirect()->back()->with('action', 'success');

    }

    public function editPeople(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpg,jpeg,png|max:10048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }
        $people = People::find($request->id_people);
        $people->name = $request->name;
        $people->slug = $request->slug;
        $people->position = $request->position;
        $people->description = $request->description;

        if($file = $request->file('file')){
            $file->storeAs('public/people', $file->hashName());
            $people->image = $file->hashName();
        }
        $people->save();

        //Add Journal
        $pplJournals = new PeopleJournals();
        $pplJournals->where('id_people', $request->id_people)->delete();
        $data = json_decode($request->journals);
        foreach($data as $row)
        {
            $people_journals = new PeopleJournals();
            $people_journals->id_people = $people->id_people;
            $people_journals->id_journal = $row->id_journal;
            $people_journals->save();
        }
        
        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function deletePeople($id)
    {
        $people = People::find($id);
        $people->delete();
        Storage::delete('public/people'.$people->file);
        return redirect()->back()->with('action', 'success');
    }
}
