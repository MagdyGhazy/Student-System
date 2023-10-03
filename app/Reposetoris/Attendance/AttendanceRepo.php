<?php

namespace App\Reposetoris\Attendance;

use App\Models\Absence;
use App\Models\Student;

class AttendanceRepo
{

    public function getGroupStudentsAttendance($group_id)
    {
        return Student::where('group_id',$group_id)->orWhere('change_group_id',$group_id)->get();
    }


    public function makeAttend($student_id)
    {
        $student = Student::find($student_id);
        $student->setAttribute('status','attend')->save();
    }


    public function makeAbsent($student_id)
    {
        $student = Student::find($student_id);
        $student->setAttribute('status','absent')->save();
    }

    public function TakeAbsence($data)
    {
         Absence::create($data);
    }

    public function checkToRevert()
    {
        return Student::where('status','idle')->first();
    }

    public function getAllStudents()
    {
        return Student::all();
    }

    public function revertStatus($student)
    {
        $student->setAttribute('status','idle');
        $student->setAttribute('change_group',false);
        $student->setAttribute('change_group_id',null);
        $student->save();
    }
}
