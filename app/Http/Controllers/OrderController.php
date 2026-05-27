<?php

namespace App\Http\Controllers;

use App\Models\Labtest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Sample;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function addProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $random_ten_digit = rand(1000000000,9999999999);
        $date = Carbon::now()->toDateString();

        $projectM = new Project();
        $projectM->id_user = Auth::user()->id;
        $projectM->no_order = $random_ten_digit.'-'.str_replace("-","",$date);
        $projectM->project_name = $request->project_name;
        $projectM->project_location = $request->project_location;
        $projectM->pic = $request->pic;
        $projectM->company_name = $request->company_name;
        $projectM->current_step = 'pilihlab';
        $projectM->sidebar_step = 1;
        $projectM->status = 'waiting';
        $projectM->email = $request->email;
        $projectM->phone = $request->phone;
        $projectM->address = $request->address;
        if($files = $request->file('file')){
            $files->storeAs('public/project/docs', $files->getClientOriginalName());
            $projectM->file = $files->getClientOriginalName();
        }
        $projectM->save();

        //Save session
        Session::put('id_project', $projectM->id_project);

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function addOrders(Request $request)
    {
        $data = json_decode($request->json_object);
        foreach($data as $row){
            $orderM = new Order();
            $orderM->id_sample = $row->id_sample;
            $orderM->quantity = $row->qty;
            $orderM->total = $row->qty * $row->price_rates;
            $orderM->id_project = Session::get('id_project');
            $orderM->save();
        }
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'quotation';
        $projectM->sidebar_step = 2;
        $projectM->save();
        
        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function confirmQuotation(Request $request)
    {
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'pengiriman';
        $projectM->sidebar_step = 3;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function pengirimanConfirm(Request $request)
    {
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'preparasi';
        $projectM->sidebar_step = 4;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function preparasiConfirm(Request $request)
    {
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'labtest';
        $projectM->sidebar_step = 5;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function labtestConfirm()
    {
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'invoice';
        $projectM->sidebar_step = 6;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function invoiceConfirm()
    {
        $projectM = Project::find(Session::get('id_project'));
        $projectM->current_step = 'download';
        $projectM->sidebar_step = 7;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function setProjectSession(Request $request)
    {
        Session::put('id_project', $request->id_project);
        $projectM = new Project();
        $data = $projectM->find($request->id_project);

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return response()->json($response, 200);
    }

    public function ajaxData(Request $request)
    {
        $data = Order::with(['sample'])->where('id_project', $request->id_project)->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '
            <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalOrder"
            data-id_order="'.$row->id_order.'" data-sample_name="'.$row->sample->name.'" data-id_sample="'.$row->id_sample.'"
            data-quantity="'.$row->quantity.'" data-total="'.$row->total.'" data-price_rates="'.$row->sample->price_rates.'"
            data-id_project="'.$row->id_project.'"><i class="fa fa-edit"></i></button>
            <a href="'.route("order.delete", ["id" => $row->id_order]).'" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function selectData(Request $request)
    {
        $data = Sample::where('id_sample', $request->id_sample)->first();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return response()->json($response, 200);
    }

    public function editData(Request $request)
    {
        $orderM = Order::find($request->id_order);
        $orderM->id_sample = $request->id_sample;
        $orderM->id_project = $request->id_project;
        $orderM->quantity = $request->quantity;
        $orderM->total = $request->total;
        $orderM->save();

        return redirect()->back()->with('action', 'success');
    }

    public function addData(Request $request)
    {
        $orderM = new Order();
        $orderM->id_sample = $request->id_sample;
        $orderM->id_project = $request->id_project;
        $orderM->quantity = $request->quantity;
        $orderM->total = $request->total;
        $orderM->save();

        $labtest = new Labtest();
        $labtest->id_order = $orderM->id_order;
        $labtest->selesai_qty = 0;
        $labtest->save();

        return redirect()->back()->with('action', 'success');
    }

    public function deleteOrder($id)
    {
        $orderM = Order::find($id);
        $orderM->delete();

        return redirect()->back();
    }
}
