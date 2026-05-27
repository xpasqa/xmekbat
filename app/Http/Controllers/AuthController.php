<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Pricelist;
use App\Models\Sample;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
        $testInfo = new Sample();
        $slider = new Slider();
        $newsM = new News();
        $pricelist = new Pricelist();
        $data['testInfo'] = $testInfo->with(['images'])->get();
        $data['slider'] = $slider->get();
        $data['news'] = $newsM->with(['tags'])->where('type', 'News')->orderBy("created_at", "DESC")->limit(4)->get();
        $data['irms'] = $newsM->with(['tags'])->where('type', 'IRMS')->orderBy("created_at", "DESC")->limit(4)->get();
        $data['pricelist'] = $pricelist->first();
        return view('pages.home', $data);
    }

    public function login(Request $request)
    {
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        $data = Auth::user();
        return $data;
    }

    public function verifyEmail(Request $request)
    {
        $userM = new User();
        $user = $userM->where('email', '=', $request->email)->first();

        if(isset($user))
        {
            return response()->json(['status' => false, 'message' => 'Email already exist'], 200);
        }
        else
        {
            return response()->json(['status' => true, 'message' => 'Email can be used'], 200);
        }
    }

    public function createAccount(Request $request)
    {
        $dateTime = Carbon::now()->toDateTimeString();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'user';
        $user->email_verified_at = $dateTime;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['status' => true, 'message' => 'Account created'], 200);
    }

    //RESET CYCLE
    public function forgot(Request $request)
    {
        $userM = new User();
        $isValid = $userM->where('email', $request->email)->first()->count();
        if($isValid > 0)
        {
            $random = rand();
            $data = [
                'email' => $request->email,
                'remember_token' => $random,
                'route' => route('auth.reset', ["email" => $request->email, "remember_token" => $random])
            ];
            Mail::send('forgot.link', $data, function ($message) use ($request) {
                $message->from('ahmadriki9512@gmail.com', 'GeoMechanics ITB');
                $message->to($request->email);
                $message->subject('Reset Password GeoMechanics ITB');
            });

            $userM->where('email', '=', $request->email)->update(['remember_token' => $random]);

            $response['status'] = true;
            $response['code'] = 200;
            $response['message'] = 'success';
            return response()->json($response, 200);
        }
        else
        {
            $response['status'] = false;
            $response['code'] = 400;
            $response['message'] = 'failed';
            return response()->json($response, 400);
        }
        
    }

    public function resetInput($email, $remember_token)
    {
        $userM = new User();
        $data['user'] = $userM->where('email', $email)->where('remember_token', $remember_token)->first();

        if($data['user'] == null)
        {
            return 'Email / Token Reset Tidak Valid';
        }

        return view('forgot.input', $data);
    }

    public function postResetPassword(Request $request)
    {
        $userM = new User();
        $data = $userM->where('email', $request->email)->where('remember_token', $request->remember_token)->first();

        if($data == null)
        {
            return redirect()->back();
        }
        else{

            $userUpdateM = User::find($data['id']);
            $userUpdateM->password = Hash::make($request->password);
            $userUpdateM->save();

            return redirect()->back()->with('success', 'Reset password successfully');
        }
    }
    //END RESET CYCLE

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function pilihlab()
    {
        return view('order.pilihlab');
    }
}
