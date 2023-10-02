<?php

namespace App\Services\Attendance;

use App\Reposetoris\Attendance\AttendanceRepo;

class TakeAttendanceService
{
    protected $attendanceRepo;
    public function __construct()
    {
        $this->attendanceRepo = new AttendanceRepo();
    }

    /** -----------Start Group Attendance----------- **/

    public function startGroupAttendance($request)
    {
        $group_id =$request->group_id;
        $students = $request->students;

        $groupAllStudents = $this->getStartedGroupStudents($group_id);

        $this->makeAttendance($groupAllStudents,$students);
        $this->makeAbsence($groupAllStudents);

        $this->revertStatus($group_id);

        return response()->json(["message" => "Attendance Taken"]);
    }

    public function getStartedGroupStudents($group_id)
    {
        $groupAllStudents =  $this->attendanceRepo->getGroupStudentsAttendance($group_id);;

        foreach ($groupAllStudents as $student)
        {
            if ($student['change_group'] == false || $student['change_group_id'] == $group_id )
            {
                $groupStudents[] = $student['id'];
            }
        }
        return $groupStudents;
    }

    public function makeAttendance($groupAllStudents,$students)
    {
        foreach ($students as $student) {
            if (in_array($student, $groupAllStudents)) {
                $this->attendanceRepo->makeAttend($student);
            }
        }
    }

    public function makeAbsence($groupAllStudents)
    {
        $Absencestudents = $this->attendanceRepo->getAbsenceStudents($groupAllStudents);

        foreach ($Absencestudents as $student) {
            $this->attendanceRepo->makeAbsent($student);
        }
    }



    public function revertStatus($group_id)
    {
        $groupMainStudents =  $this->attendanceRepo->getGroupMainStudents($group_id);
        foreach ($groupMainStudents as $student) {
            if ($student['status'] == "attend")
            {
                $this->attendanceRepo->revertStatus($student);
            }
            elseif ($student['status'] == "absent")
            {
                $this->TakeAbsence($student,$group_id);
                $this->attendanceRepo->revertStatus($student);
            }
        }
    }


    public function TakeAbsence($student,$group_id)
    {
        $data['day'] = now();
        $data['student_id'] = $student['id'];
        $data['group_id'] = $group_id;
        $this->attendanceRepo->TakeAbsence($data);
    }

}
