<?php

namespace App\Http\Controllers;

use App\Models\Journals;
use App\Models\Labtest;
use App\Models\Order;
use App\Models\Preparation;
use App\Models\Pricelist;
use App\Models\Project;
use App\Models\Sample;
use App\Models\SurveyKepuasan;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function index()
    {
        $data['total_user'] = User::get()->count();
        $data['total_project'] = Project::get()->count();
        $data['labtest'] = Labtest::get();
        $data['url_data'] = route('admin.ajax-datatable');
        return view('admin.index', $data);
    }

    //User
    public function manageUser()
    {
        return view('admin.user');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('action', 'success');
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('action', 'success');
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->back()->with('action', 'success');
    }

    //Project order
    public function manageProject()
    {
        $data['waiting'] = Project::where('status', 'waiting')->count();
        $data['accepted'] = Project::where('status', 'accepted')->count();
        $data['preparing'] = Project::where('status', 'preparing')->count();
        $data['testing'] = Project::where('status', 'testing')->count();
        $data['invoicing'] = Project::where('status', 'invoicing')->count();
        $data['completed'] = Project::where('status', 'completed')->count();
        $data['archived']  = Project::onlyTrashed()->count();
        return view('admin.project', $data);
    }

    public function manageDetailProject($id)
    {
        $data['id'] = $id;
        $data['project'] = Project::find($id);
        $data['sample'] = Sample::where('type', 'Sample')->get();
        $data['survey'] = SurveyKepuasan::where('id_project', $id)->first();
        return view('admin.detailproject', $data);
    }

    public function pdfDetailProject($id)
    {
        $data['project'] = Project::with(['orders', 'orders.sample', 'notes', 'orders.labtest'])->find($id);
        $survey = SurveyKepuasan::where('id_project', $id)->get();
        $myArray = [];
        array_push($myArray, (object)[
            'name' => 'Ketepatan Waktu',
            'value' => $survey[0]->ketepatan_waktu,
        ]);
        array_push($myArray, (object)[
            'name' => 'Komunikasi',
            'value' => $survey[0]->komunikasi,
        ]);
        array_push($myArray, (object)[
            'name' => 'Kejelasan',
            'value' => $survey[0]->kejelasan,
        ]);
        array_push($myArray, (object)[
            'name' => 'Informasi',
            'value' => $survey[0]->informasi,
        ]);
        $data['survey'] = $myArray;
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait')->loadView('admin.pdf', $data);
        return $pdf->stream();
    }

    //Sample
    public function manageSample()
    {
        return view('admin.sample');
    }

    //Tag
    public function manageTag()
    {
        return view('admin.tag');
    }

    public function manageNews()
    {
        $data['tags'] = Tag::get();
        return view('admin.news', $data);
    }

    public function managePreparation()
    {
        $data['preps'] = Preparation::get()->count();
        return view('admin.preparation', $data);
    }

    public function manageTestInfo()
    {
        $data['preps'] = Preparation::get()->count();
        return view('admin.testinfo', $data);
    }

    public function manageJournals()
    {
        return view('admin.journals');
    }

    public function managePeople()
    {
        $data['journals'] = Journals::get();
        return view('admin.people', $data);
    }

    public function manageSlider()
    {
        return view('admin.slider');
    }

    public function managePricelist()
    {
        $data['pricelist'] = Pricelist::get();
        return view('admin.pricelist', $data);
    }

    public function ajaxDataTable()
    {
        $data = User::select("*");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button class="open-edit btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModalTambah"
                data-id="'.$row->id.'" data-name="'.$row->name.'" data-email="'.$row->email.'" data-role="'.$row->role.'"><i class="fa fa-edit"></i> </button></div>
                <a href="/admin/manage/user/delete/' . $row->id . '" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"/></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
