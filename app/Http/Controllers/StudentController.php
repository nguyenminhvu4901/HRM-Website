<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Enums\StudentStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Students\StoreRequest;
use App\Http\Requests\Students\UpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $arrStudentStatus = StudentStatusEnum::getArrayView();
        view()->share('arrStudentStatus', $arrStudentStatus);
    }


    public function index()
    {
        $students = Student::with('course')->get();
        //session()->flash('message', 'Dang nhap thanh cong');
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();
        $fileName = $request->file('avatar')->getClientOriginalName();
        $request->avatar->move(public_path('avatars'), $fileName);
        $data['avatar'] = $fileName;
        $data['password'] = Hash::make($data['password']);
        $student = Student::create($data);
        session()->flash('message', 'Them sinh vien thanh cong');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Student::find($id);
        return view('students.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Student::find($id);
        $courses = Course::all();
        return view('students.edit', compact('item', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $student = Student::find($id);
        $data = $request->safe()->all();
        if ($request->avatar) {
            $fileName = time() . '' . $request->file('avatar')->getClientOriginalName();
            $request->avatar->move(public_path('avatars'), $fileName);
            $data['avatar'] = $fileName;
        }
        $student->update($data);
        session()->flash('message1', 'Thay doi thong tin sinh vien thanh cong');
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Soft Delete
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        session()->flash('message', 'Xoa thanh cong');
        return redirect()->route('students.index');
    }
    //View Trash
    public function trashed()
    {
        $students = Student::with('course')->onlyTrashed()->get();
        return view('students.trashes', compact('students'));
    }

    public function restore($id)
    {
        Student::withTrashed()->find($id)->restore();
        $students = Student::with('course')->onlyTrashed()->get();
        session()->flash('message', 'Restore thanh cong');
        return redirect()->route('students.trashed');
    }

    public function restoreAll()
    {
        Student::with('course')->onlyTrashed()->restore();
        session()->flash('message', 'Restore tat ca thanh cong');
        return redirect()->route('students.trashed');
    }

    public function forceDelete($id)
    {
        Student::withTrashed()->find($id)->forceDelete();
        session()->flash('message', 'Xoa thanh cong');
        return redirect()->route('students.trashed');
    }

    public function forceDeleteAll()
    {
        Student::with('course')->onlyTrashed()->forceDelete();
        session()->flash('message', 'Xoa tat ca thanh cong');
        return redirect()->route('students.trashed');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function changePassword($id)
    {
        $item = Student::find($id);
        return view('students.changePassword', compact('item'));
    }
}
