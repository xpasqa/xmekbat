<?php

namespace App\Http\Controllers;

use App\Models\Preparation;
use Illuminate\Http\Request;

class PreparationController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Preparation::select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_sample="'.$row->id_sample.'" data-name="'.$row->name.'" data-price_rates="'.$row->price_rates.'" 
                data-sample_rates="'.$row->sample_rates.'">
                <i class="fa fa-edit"></i> </button></div>
                <a href="/preparation/delete/' . $row->id_sample . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addPreparation(Request $request)
    {
        $preparation = new Preparation();
        $preparation->name = $request->name;
        $preparation->price_rates = $request->price_rates;
        $preparation->sample_rates = $request->sample_rates;
        $preparation->save();
        return redirect()->back()->with('action', 'success');
    }

    public function editPreparation(Request $request)
    {
        $preparation = Preparation::find($request->id_sample);
        $preparation->name = $request->name;
        $preparation->price_rates = $request->price_rates;
        $preparation->sample_rates = $request->sample_rates;
        $preparation->save();
        return redirect()->back()->with('action', 'success');
    }

    public function deletePreparation($id)
    {
        $preparation = Preparation::find($id);
        $preparation->delete();
        return redirect()->back()->with('action', 'success');
    }
}
