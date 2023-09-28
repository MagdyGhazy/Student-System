<?php

namespace App\Services\Attendance;

use App\Models\Group;
use App\Reposetoris\Attendance\AttendanceRepo;

class TakeAttendanceService
{
    protected $attendanceRepo;
    public function __construct()
    {
        $this->attendanceRepo = new AttendanceRepo();
    }


    public function startGroupAttendance($group_id)
    {
        $data['is_started'] = true;
        $data['is_ended'] = false;
        $this->attendanceRepo->startEndGroupAttendance($data,$group_id);
        return response()->json(["message"=>"Attendance Starts"]);
    }

    public function endGroupAttendance($group_id)
    {
        $data['is_started'] = false;
        $data['is_ended'] = true;
        $this->attendanceRepo->startEndGroupAttendance($data,$group_id);
        $absenceStudents = $this->attendanceRepo->getAbsenceStudents($group_id);
        $this->takeStudentAbsence($absenceStudents,$group_id);
        $this->revertStudentAttendStatus($group_id);
        return response()->json([
            "message" => "Absence has been Taken"
        ]);
    }

    public function takeStudentAttendance($student_id)
    {
        $data['is_attend'] = true;
        $this->attendanceRepo->TakeAttendance($student_id,$data);
        return response()->json(["message"=>"Student Attendance has been Taken"]);
    }

    public function takeStudentAbsence($absenceStudents,$group_id)
    {
        foreach ($absenceStudents as $student)
        {
            $data['day'] =now();
            $data['student_id'] =$student->id;
            $data['group_id'] =$group_id;
            $this->attendanceRepo->TakeAbsence($data);
        }
    }

    public function revertStudentAttendStatus($group_id)
    {
        $students = $this->attendanceRepo->revertStudentAttendStatus($group_id);
        foreach ($students as $student)
        {
            $student->setAttribute('is_attend',false)->save();
        }
    }

}
