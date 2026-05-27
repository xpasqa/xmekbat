<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\SampleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SampleController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Sample::with(['images'])->select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning mr-1" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_sample="'.$row->id_sample.'" data-name="'.$row->name.'" data-price_rates="'.$row->price_rates.'" 
                data-sample_rates="'.$row->sample_rates.'" data-type="'.$row->type.'" data-output="'.$row->output.'"
                data-method="'.$row->method.'" data-standard_method_description="'.$row->standard_method_description.'"
                data-output_description="'.$row->output_description.'" data-display="'.$row->display.'">
                <i class="fa fa-edit"></i> </button>
                <button class="open-image btn btn-sm btn-outline-info mr-1" data-toggle="modal" data-target="#exampleEditImage"
                data-id_sample="'.$row->id_sample.'">
                <i class="fa fa-image"></i> </button>
                <a href="/sample/delete/' . $row->id_sample . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a></div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxSelectOne(Request $request)
    {
        $data = Sample::with(['images'])->where('id_sample', $request->id_sample)->first();
        return response()->json($data);
    }

    public function deleteImageFromSample(Request $request)
    {
        $data = SampleImage::where('id_sample_image', $request->id_sample_image)->first();
        Storage::delete($data->image);
        $data->delete();
        return response()->json($data);
    }

    public function addSample(Request $request)
    {
        $sample = new Sample();
        $sample->name = $request->name;
        $sample->price_rates = $request->price_rates;
        $sample->sample_rates = $request->sample_rates;
        $sample->type = $request->type;
        $sample->output = $request->output;
        $sample->method = $request->method;
        $sample->standard_method_description = $request->standard_method_description;
        $sample->output_description = $request->output_description;
        $sample->display = $request->display;
        $sample->save();

        if($files1 = $request->file('images0')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files1->hashName();
            $files1->storeAs('public/testinfo', $files1->hashName());
            $sampleImage->save();
        }
        if($files2 = $request->file('images1')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files2->hashName();
            $files2->storeAs('public/testinfo', $files2->hashName());
            $sampleImage->save();
        }
        if($files3 = $request->file('images2')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files3->hashName();
            $files3->storeAs('public/testinfo', $files3->hashName());
            $sampleImage->save();
        }
        
        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function editSample(Request $request)
    {
        $sample = Sample::find($request->id_sample);
        $sample->name = $request->name;
        $sample->price_rates = $request->price_rates;
        $sample->sample_rates = $request->sample_rates;
        $sample->type = $request->type;
        $sample->output = $request->output;
        $sample->method = $request->method;
        $sample->standard_method_description = $request->standard_method_description;
        $sample->output_description = $request->output_description;
        $sample->display = $request->display;
        $sample->save();

        if($files1 = $request->file('images0')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files1->hashName();
            $files1->storeAs('public/testinfo', $files1->hashName());
            $sampleImage->save();
        }
        if($files2 = $request->file('images1')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files2->hashName();
            $files2->storeAs('public/testinfo', $files2->hashName());
            $sampleImage->save();
        }
        if($files3 = $request->file('images2')){
            $sampleImage = new SampleImage();
            $sampleImage->id_sample = $sample->id_sample;
            $sampleImage->image = $files3->hashName();
            $files3->storeAs('public/testinfo', $files3->hashName());
            $sampleImage->save();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function deleteSample($id)
    {
        $sample = Sample::find($id);
        $sample->delete();
        $sampleImage = SampleImage::where('id_sample', $id)->get();
        foreach($sampleImage as $row){
            Storage::delete('public/testinfo/'.$row->image);
        }
        return redirect()->back()->with('action', 'success');
    }
}
