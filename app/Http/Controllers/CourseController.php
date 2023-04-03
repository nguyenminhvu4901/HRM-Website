<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Http\Parser\Cookies;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\Courses\StoreRequest;
use App\Http\Requests\Courses\UpdateRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::all();
        return view('courses.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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
        $course = Course::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'open' => $data['open'],
        ]);
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Course::find($id);
        return view('courses.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Course::find($id);
        return view('courses.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->safe()->all();
        $course = Course::find($id);
        $course->update($data);
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $student = Student::where('course_id', $id)->firstOrFail();
        if ($student) {
            return "Ban ko dc xoa";
        }
        $course->delete();
        return redirect()->route('courses.index');
    }

    //View Trash
    public function trashed()
    {
        $courses = Course::with('course')->onlyTrashed()->get();
        return view('courses.trashes', compact('courses'));
    }

    public function restore($id)
    {
        Course::withTrashed()->find($id)->restore();
        $courses = Course::onlyTrashed()->get();
        return redirect()->route('courses.trashed');
    }

    public function restoreAll()
    {
        Course::onlyTrashed()->restore();
        return redirect()->route('courses.trashed');
    }

    public function forceDelete($id)
    {
        Course::withTrashed()->find($id)->forceDelete();
        return redirect()->route('courses.trashed');
    }

    public function forceDeleteAll()
    {
        Student::onlyTrashed()->forceDelete();
        return redirect()->route('courses.trashed');
    }

    public function logout(Request $request)
    {
        dd(session()->get('id'));
        return redirect()->route('login');
    }
}
