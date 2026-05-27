<?php

namespace App\Http\Controllers;

use App\Models\TestInfo;
use App\Models\TestInfoImage;
use Illuminate\Http\Request;

class TestInfoController extends Controller
{
    public function ajaxDataTable()
    {
        $data = TestInfo::with(['images'])->select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_test_info="'.$row->id_test_info.'" data-name="'.$row->name.'" data-output="'.$row->output.'" 
                data-method="'.$row->method.'" data-standard_method_description="'.$row->standard_method_description.'" 
                data-output_description="'.$row->output_description.'"><i class="fa fa-edit"></i> </button></div>
                <a href="/testinfo/delete/' . $row->id_test_info . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addTestInfo(Request $request)
    {
        $testInfo = new TestInfo;
        $testInfo->name = $request->name;
        $testInfo->output = $request->output;
        $testInfo->method = $request->method;
        $testInfo->standard_method_description = $request->standard_method_description;
        $testInfo->output_description = $request->output_description;
        $testInfo->save();
        
        return redirect()->back()->with('action', 'success');
    }

    public function deleteTestInfo($id)
    {
        $test_info = TestInfo::find($id);
        $test_info->delete();
        return redirect()->back()->with('action', 'success');
    }

    public function editTestInfo(Request $request)
    {
        $test_info = TestInfo::find($request->id_test_info);
        $test_info->name = $request->name;
        $test_info->output = $request->output;
        $test_info->method = $request->method;
        $test_info->standard_method_description = $request->standard_method_description;
        $test_info->output_description = $request->output_description;
        $test_info->save();
        return redirect()->back()->with('action', 'success');
    }
}