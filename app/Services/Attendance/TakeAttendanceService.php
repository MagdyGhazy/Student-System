<?php

namespace App\Services\Attendance;

use App\Reposetoris\Attendance\AttendanceRepo;
use function Laravel\Prompts\password;

class TakeAttendanceService
{
    protected $attendanceRepo;
    public function __construct()
    {
        $this->attendanceRepo = new AttendanceRepo();
    }


    public function startGroupAttendance($request)
    {
        $group_id =$request->group_id;
        $students = $request->students;

        $groupAllStudents = $this->getStartedGroupStudents($group_id);

        $this->takeAttendance($groupAllStudents,$students,$group_id);

        $this->revertStatus();
        return response()->json(["message" => "Attendance Taken"]);
    }


    public function getStartedGroupStudents($group_id)
    {
        $groupAllStudents =  $this->attendanceRepo->getGroupStudentsAttendance($group_id);

        foreach ($groupAllStudents as $student)
        {
            if ($student['change_group'] == false || $student['change_group_id'] == $group_id )
            {
                $groupStudents[] = $student['id'];
            }
        }
        return $groupStudents;
    }



    public function takeAttendance($groupAllStudents,$students,$group_id)
    {
        foreach ($groupAllStudents as $student) {
            if (in_array($student, $students)) {
                $this->attendanceRepo->makeAttend($student);
            }else{
            $this->attendanceRepo->makeAbsent($student);
            $this->takeAbsence($student, $group_id);
            }
        }
    }


    public function takeAbsence($student,$group_id)
    {
        $data['day'] = now();
        $data['student_id'] = $student;
        $data['group_id'] = $group_id;
        $this->attendanceRepo->TakeAbsence($data);
    }

    public function revertStatus()
    {
        $idle = $this->attendanceRepo->checkToRevert();
        if ($idle == null)
        {
            $allStudents = $this->attendanceRepo->getAllStudents();

            foreach ($allStudents as  $student)
            {
                $this->attendanceRepo->revertStatus($student);
            }
        }
    }
}

