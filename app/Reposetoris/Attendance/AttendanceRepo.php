<?php

namespace App\Reposetoris\Attendance;

use App\Models\Absence;
use App\Models\Group;
use App\Models\Student;

class AttendanceRepo
{
    public function getGroup($id)
    {
        return  Group::findOrFail($id);

    }
    public function startEndGroupAttendance($data,$group_id)
    {
        $group = $this->getGroup($group_id);
        $group->setAttribute('is_started',$data['is_started']);
        $group->setAttribute('is_ended',$data['is_ended']);
        $group->save();

    }

    public function getStartedGroup()
    {
        $group = Group::with('student')->whereIs_started(true)->get();
        return $group;
    }

    public function getGroupStudents()
    {
        $groups = $this->getStartedGroup();
        $students = [];
        foreach ($groups as $group) {
            $students = $group->student;
        }
        return $students;
    }

    public function TakeAttendance($student_id,$data)
    {
        $students = $this->getGroupStudents();
        $student = $students->where("id",$student_id)->first();
        $student->setAttribute('is_attend',$data['is_attend'])->save();
    }

    public function getAbsenceStudents($group_id)
    {
        return Student::where("group_id",$group_id)->where("change_group",false)->where("is_attend",false)->get() ;
    }

    public function TakeAbsence($data)
    {
        Absence::create($data);
    }

    public function revertStudentAttendStatus($group_id)
    {
        return Student::where("group_id",$group_id)->where("change_group",false)->where("is_attend",true)->get() ;
    }

}
