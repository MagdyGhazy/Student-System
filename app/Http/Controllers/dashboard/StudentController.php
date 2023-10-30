<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;
use Mockery\Exception;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('dashboard.students.index',compact('students'));
    }

    public function create()
    {
        $groups = Group::all();
        $grades = Grade::all();
        $parents = Guardian::all();
        return view('dashboard.students.create',compact('grades','groups','parents'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $groups = Group::all();
        $grades = Grade::all();
        return view('dashboard.students.update',compact('student','grades','groups'));
    }

    public function store(Request $request)
    {
        try {
            $parent =   Guardian::create([
                'name'=>$request['parent'],
                'phone'=> $request['p_phone'],
                'password'=> bcrypt($request['p_phone']),
            ]);

            Student::create([
                'name'=>$request['name'],
                'phone'=> $request['phone'],
                'password'=> bcrypt($request['phone']),
                'group_id'=> $request['group'],
                'grade_id'=> $request['grade'],
                'parent_id'=> $parent['id'],
            ]);

            return redirect()->route('students');

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }


    public function update(Request $request)
    {
        $student = Student::findOrFail($request['student_id']);
        try {
            $student->parent->update([
                'name'=>$request['parent'],
                'phone'=> $request['p_phone'],
            ]);

            $student->update([
                'name'=>$request['name'],
                'phone'=> $request['phone'],
                'group_id'=> $request['group'],
                'grade_id'=> $request['grade'],
            ]);

            return redirect()->route('students');

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function delete(Request $request)
    {
        $student = Student::findOrFail($request->id);
        $student->delete();
        return redirect()->route('students');
    }

}
