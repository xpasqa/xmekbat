<?php

namespace App\Http\Controllers;

use App\Models\HasilImage;
use App\Models\Labtest;
use App\Models\Notes;
use App\Models\Order;
use App\Models\Preparing;
use App\Models\PreparingImage;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ProjectController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Project::with(['hasil_image'])->select("*");
        return datatables($data)->make(true);
    }

    public function ajaxByStatus(Request $request)
    {
        $data = Project::with(['hasil_image'])->select("*")->where('status', $request->status);
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <a href="/admin/manage/detail-project/' . $row->id_project . '" class="btn btn-sm btn-info mr-1"><span class="fa fa-eye"/></a>
                <button class="btn btn-sm btn-success status" data-toggle="modal" data-target="#exampleModalTambah"
                data-id_project="'.$row->id_project.'" data-no_order="'.$row->no_order.'" data-project_name="'.$row->project_name.'" 
                data-project_location="'.$row->project_location.'" data-pic="'.$row->pic.'" data-company_name="'.$row->company_name.'"
                data-company_address="'.$row->company_address.'"><i class="fa fa-check"></i> </button></div>
                <a href="/project/delete/' . $row->id_project . '" class="btn btn-sm btn-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxArchived()
    {
        $data = Project::onlyTrashed()->with(['hasil_image'])->select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group">
                    <a href="/project/restore/' . $row->id_project . '" class="btn btn-sm btn-secondary"><span class="fa fa-sync"/></a>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAjaxLabtest(Request $request)
    {
        $data = Order::with(['labtest', 'sample'])->select("*")->where('id_project', $request->id_project);
        return datatables($data)->make(true);
    }

    public function getAjaxHasilImage(Request $request)
    {
        $data = HasilImage::select("*")->where('id_project', $request->id_project);
        return datatables($data)->make(true);
    }

    public function ajaxDetailProjectDataTable(Request $request)
    {
        $data = Project::with(['preparing_image', 'notes'])->where('id_project', $request->id)->select("*");
        if($request->type == 'preparation'){
            return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-info" data-toggle="modal" data-target="#exampleModalPreparasi"
                    data-id_project="'.$row->id_project.'"><i class="fa fa-eye"></i> </button></div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        else if($request->type == 'invoicing'){
            return datatables($data)->make(true);
        }
        else{
            return datatables($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                    <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                    data-id_project="'.$row->id_project.'" data-no_order="'.$row->no_order.'" data-project_name="'.$row->project_name.'" 
                    data-project_location="'.$row->project_location.'" data-pic="'.$row->pic.'" data-company_name="'.$row->company_name.'"
                    data-company_address="'.$row->company_address.'" data-status="'.$row->status.'" data-email="'.$row->email.'"
                    data-phone="'.$row->phone.'"><i class="fa fa-edit"></i> </button></div>
                    <a href="/project/delete/' . $row->id_project . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

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
        $projectM->company_address = $request->company_address;
        $projectM->current_step = 'pilihlab';
        $projectM->status = 'waiting';
        $projectM->email = $request->email;
        $projectM->phone = $request->phone;
        if($files = $request->file('file')){
            $files->storeAs('public/project/docs', $files->hashName());
            $projectM->file = $files->hashName();
        }
        $projectM->save();

        return redirect()->back()->with('action', 'success');
    }

    public function editProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4048'
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $projectM = Project::find($request->id_project);
        $projectM->no_order = $request->no_order;
        $projectM->project_name = $request->project_name;
        $projectM->project_location = $request->project_location;
        $projectM->pic = $request->pic;
        $projectM->company_name = $request->company_name;
        $projectM->company_address = $request->company_address;
        $projectM->email = $request->email;
        $projectM->phone = $request->phone;
        if($files = $request->file('file')){
            $files->storeAs('public/project/docs', $files->hashName());
            $projectM->file = $files->hashName();
        }
        $projectM->save();

        return redirect()->back()->with('action', 'success');
    }

    public function changeStatus(Request $request)
    {
        $projectM = Project::find($request->id_project);
        if($projectM->status == 'waiting'){
            $projectM->status = 'accepted';
        }
        else if($projectM->status == 'accepted'){
            $projectM->status = 'preparing';
        }
        $projectM->accepted_at = Carbon::now()->toDateString();
        $projectM->estimated_opened = $request->estimated_opened;
        $projectM->save();

        return redirect()->back()->with('action', 'success');
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->back()->with('action', 'success');
    }

    public function restoreProject($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->restore();
        return redirect()->back()->with('action', 'success');
    }

    public function deleteResponseJson($id)
    {
        $project = Project::find($id);
        $project->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function ajaxAddPreparasiSample(Request $request)
    {
        $arr_length = count(json_decode($request->sample_code));
        $sample_code_arr = json_decode($request->sample_code);
        $depth = json_decode($request->depth);
        $length = json_decode($request->length);
        $lithology = json_decode($request->lithology);
        $pp = json_decode($request->pp);
        $ucs = json_decode($request->ucs);
        $ds = json_decode($request->ds);
        $uv = json_decode($request->uv);
        $pli = json_decode($request->pli);
        $bz = json_decode($request->bz);
        $tx = json_decode($request->tx);
        $notice = json_decode($request->notice);

        Preparing::where('id_project', $request->id_project)->delete();

        for($i=0; $i<$arr_length; $i++){
            $preparingM = new Preparing();
            $preparingM->id_project = $request->id_project;
            $preparingM->sample_code = $sample_code_arr[$i];
            $preparingM->depth = $depth[$i];
            $preparingM->length = $length[$i];
            $preparingM->lithology = $lithology[$i];
            $preparingM->pp = intval($pp[$i]);
            $preparingM->ucs = intval($ucs[$i]);
            $preparingM->ds = intval($ds[$i]);
            $preparingM->uv = intval($uv[$i]);
            $preparingM->pli = intval($pli[$i]);
            $preparingM->bz = intval($bz[$i]);
            $preparingM->tx = intval($tx[$i]);
            $preparingM->notice = $notice[$i];
            $preparingM->save();
        }
        $checkNotes = Notes::where('id_project', $request->id_project)->first();
        if($checkNotes == null)
        {
            $notesM = new Notes();
            $notesM->id_project = $request->id_project;
            $notesM->notes = $request->notes;
            $notesM->save();
        }
        else{
            $checkNotes->notes = $request->notes;
            $checkNotes->save();
        }
        
        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function ajaxDeletePreparasiSample(Request $request)
    {
        $preparingM = Preparing::where('id_project', $request->id_project)->get();
        foreach($preparingM as $preparing){
            $preparing->delete();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function getAjaxPreparasiSample(Request $request)
    {
        $preparing = Preparing::where('id_project', $request->id_project)->get();
        $notes = Notes::where('id_project', $request->id_project)->first();
        $images = PreparingImage::where('id_project', $request->id_project)->get();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $preparing;
        $response['data2'] = $notes;
        $response['data3'] = $images;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function ajaxAddPreparasiImage(Request $request)
    {
        if($files = $request->file('image')){
            $preparingImageM = new PreparingImage();
            $files->storeAs('public/feedback/images', $files->hashName());
            $preparingImageM->id_project = $request->id_project;
            $preparingImageM->image = $files->hashName();
            $preparingImageM->save();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function changeStatusAjax(Request $request)
    {
        $projectM = Project::find($request->id_project);
        if($projectM->status == 'waiting'){
            $projectM->status = 'accepted';
        }
        else if($projectM->status == 'accepted'){
            $projectM->status = 'preparing';
        }
        else if($projectM->status == 'preparing'){
            $projectM->status = 'testing';
        }
        else if($projectM->status == 'testing'){
            $projectM->status = 'invoicing';
        }
        else if($projectM->status == 'invoicing'){
            $projectM->status = 'completed';
        }
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $projectM;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function getAjaxTestSample(Request $request)
    {
        $orderM = new Order();
        $data = $orderM->with(['project', 'sample', 'labtest'])->where('id_project', $request->id_project)->get();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $data;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function getAjaxTestSample2(Request $request)
    {
        $orderM = new Order();
        $data = $orderM->with(['project', 'sample', 'labtest'])->where('id_project', $request->id_project)->get();
        return datatables($data)->make(true);
    }

    public function ajaxAddLabtest(Request $request)
    {
        $id_order = json_decode($request->id_order);
        $catatan = json_decode($request->catatan);
        $selesai_qty = json_decode($request->selesai_qty);
        $arr_length = count($id_order);

        for($i=0; $i < $arr_length; $i++){
            $labtestCheck = Labtest::where('id_order', $id_order[$i])->first();
            if($labtestCheck == null){
                $labtestM = new Labtest();
                $labtestM->id_order = $id_order[$i];
                if(!empty($selesai_qty)){
                    $labtestM->selesai_qty = $selesai_qty[$i];
                }
                if(!empty($catatan)){
                    $labtestM->catatan = $catatan[$i];
                }
                $labtestM->save();
            }
            else{
                if(!empty($selesai_qty)){
                    $labtestCheck->selesai_qty = $selesai_qty[$i];
                }
                if(!empty($catatan)){
                    $labtestCheck->catatan = $catatan[$i];
                }
                $labtestCheck->save();
            }
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $catatan;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function ajaxAddDocument(Request $request)
    {
        if($files = $request->file('file')){
            $labtestM = Labtest::find($request->id_labtest);
            Storage::delete('public/order/document/'.$labtestM->file);
            $files->storeAs('public/order/document', $files->hashName());
            $labtestM->file = $files->hashName();
            $labtestM->save();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function getProjectById(Request $request)
    {
        $projectM = new Project();
        $data = $projectM->where('id_project', $request->id_project)->first();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $data;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function uploadBukti(Request $request)
    {
        if($files = $request->file('file')){
            $projectM = Project::find($request->id_project);
            Storage::delete('public/order/bukti/'.$projectM->bukti_pembayaran);
            $files->storeAs('public/order/bukti', 'bukti-'.$files->hashName());
            $projectM->bukti_pembayaran = 'bukti-'.$files->hashName();
            $projectM->save();
        }
        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function deleteBukti(Request $request)
    {
        $projectM = Project::find($request->id_project);
        Storage::delete('public/order/bukti/'.$projectM->bukti_pembayaran);
        $projectM->bukti_pembayaran = null;
        $projectM->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }
    
    public function uploadInvoice(Request $request)
    {
        if($files = $request->file('file')){
            $projectM = Project::find($request->id_project);
            Storage::delete('public/order/invoice/'.$projectM->invoice);
            $files->storeAs('public/order/invoice', 'invoice-'.$projectM->no_order.'.pdf');
            $projectM->invoice = 'invoice-'.$projectM->no_order.'.pdf';
            $projectM->save();
        }
        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }
    
    public function addHasilImage(Request $request)
    {
        $length = count(json_decode($request->name));
        $name = json_decode($request->name);
        $id_hasil_image = json_decode($request->id_hasil_image);

        for($i=0; $i < $length; $i++){
            if(isset($id_hasil_image[$i])){
                $hasilImage = HasilImage::find($id_hasil_image[$i]);
            }
            else{
                $hasilImage = new HasilImage();
            }
            $hasilImage->id_project = $request->id_project;
            $hasilImage->name = $name[$i];
            if($image = $request->file('image-'.$i)){
                $fourdigitrandom = mt_rand(1111,9999);
                $image->storeAs('public/order/document', $fourdigitrandom.'-'.$image->getClientOriginalName());
                $hasilImage->image = $fourdigitrandom.'-'.$image->getClientOriginalName();
                $hasilImage->save();
            }
            $hasilImage->save();   
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $request->all();
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function detailProject($id_project)
    {
        $project = Project::with(['hasil_image'])->find($id_project);

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $project;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function deleteHasilImage($id_hasil_image)
    {
        $hasilImage = HasilImage::find($id_hasil_image);
        Storage::delete('public/order/document/'.$hasilImage->image);
        $hasilImage->delete();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $hasilImage;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function deleteInvoice($id)
    {
        $project = Project::find($id);
        Storage::delete('public/order/invoice/'.$project->invoice);
        $project->invoice = null;
        $project->save();

        $response['status'] = true;
        $response['code'] = 200;
        $response['data'] = $project;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }
}
