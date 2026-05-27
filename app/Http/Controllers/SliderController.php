<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Slider::select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_slider="'.$row->id_slider.'" data-image="'.$row->image.'" data-url="'.$row->url.'"><i class="fa fa-edit"></i> </button></div>
                <a href="'.route("slider.deleteSlider", ['id' => $row->id_slider]).'" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addSlider(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'url' => 'nullable',
        ]);

        $slider = new Slider;
        $file = $request->file('image');
        $file->storeAs('public/slider', $file->hashName());
        $slider->image = $file->hashName();
        if($request->url != null){
            $slider->url = $request->url;
        }
        $slider->save();

        return redirect()->back()->with('action', 'Slider berhasil ditambahkan');
    }

    public function editSlider(Request $request)
    {
        $this->validate($request, [
            'image' => 'nullable',
            'url' => 'nullable',
        ]);

        $slider = Slider::find($request->id_slider);
        if($request->image != null){
            Storage::delete('public/slider/'.$slider->image);
            $file = $request->file('image');
            $file->storeAs('public/slider', $file->hashName());
            $slider->image = $file->hashName();
        }
        if($request->url != null){
            $slider->url = $request->url;
        }
        $slider->save();

        return redirect()->back()->with('action', 'Slider berhasil diubah');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        Storage::delete('public/slider/'.$slider->image);
        return redirect()->back()->with('action', 'Slider berhasil dihapus');
    }
    
}
