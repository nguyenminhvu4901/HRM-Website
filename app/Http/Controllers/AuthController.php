<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\User;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\Register\StoreRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function processLogin(Request $request)
    {
        try {
            $user = User::query()->where('email', $request->get('email'))
                ->firstOrFail();
            //Check pass nếu ok sẽ vào
            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('Sai tài khoản hoặc mật khẩu');
            }
            // session(['id' => $employee->id]);
            // session(['name' => $employee->name]);
            // session(['avatar' => $employee->avatar]);
            // session(['level' => $employee->level]);
            // session(['ngu' => 'qia dark']);
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            //session()->put('avatar', $user->avatar);
            session()->put('level', $user->level);
            session()->flash('message', 'Dang nhap thanh cong');
            return redirect()->route('students.index');
        } catch (Throwable $e) {
            return redirect()->route('login');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function process_register(StoreRequest $request)
    {
        $data = $request->safe()->all();
        $data['password'] = Hash::make($data['password']);
        $data['level'] = 0;
        $user = User::create($data);
        if (isset($user)) {
            session()->flash('message', 'Ban da dang ky thanh cong');
            return redirect()->route('login');
        }
        session()->flash('message', 'Dang ky khong thanh cong');
        return redirect()->route('register');
    }

    public function forgetPassword()
    {
        return view('auth.forget');
    }

    public function processForgetPassword(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->firstOrFail();
        $token = Str::random(20);
        $title_mail = "Lấy lại mật khẩu";

        if ($user) {
            $user = User::find($user->id);
            $user->token = $token;
            $user->save();
            //send mail
            $to_email = $data['email'];
            $link_reset_pass = url('update-new-pass?email=' . $to_email . '&token=' . $token);
            $data = array("name" => $title_mail, "body" => $link_reset_pass, 'email' => $data['email']);

            Mail::send('auth.newPassword', $data, function ($message) use ($data, $title_mail) {
                $message->from($data['email'], $title_mail);
                $message->to($data['email'])->subject($title_mail);
                $message->html($data['name']);
            });
            return redirect()->back()->with('message', "GUi thanh cong");
        }
    }
    public function newPassword()
    {
        return view('auth.newPassword');
    }
    public function processNewPassword()
    {
        return view('auth.newPassword');
    }
}
