<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PricelistController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Pricelist::select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_pricelist="'.$row->id_pricelist.'" data-link="'.$row->link.'"><i class="fa fa-edit"></i> </button></div>
                <a href="'.route("pricelist.deletePricelist", ['id' => $row->id_pricelist]).'" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addPricelist(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $pricelist = new Pricelist;
        $file = $request->file('file');
        $file->storeAs('public/pricelist', $file->getClientOriginalName());
        $pricelist->file = $file->getClientOriginalName();
        $pricelist->save();

        return redirect()->back()->with('action', 'Pricelist berhasil ditambahkan');
    }

    public function editPricelist(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'id_pricelist' => 'required',
        ]);

        $pricelist = Pricelist::find($request->id_pricelist);
        if($request->file != null){
            Storage::delete('public/pricelist/'.$pricelist->file);
            $file = $request->file('file');
            $file->storeAs('public/pricelist', $file->getClientOriginalName());
            $pricelist->file = $file->getClientOriginalName();
        }
        $pricelist->save();

        return redirect()->back()->with('action', 'Pricelist berhasil diubah');
    }

    public function deletePricelist($id)
    {
        $pricelist = Pricelist::find($id);
        Storage::delete('public/pricelist/'.$pricelist->file);
        $pricelist->delete();

        return redirect()->back()->with('action', 'Pricelist berhasil dihapus');
    }
}
