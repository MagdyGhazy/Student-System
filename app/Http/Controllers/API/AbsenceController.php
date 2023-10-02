<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\FindStudentIdRequest;
use App\Http\Requests\System\Groups\FindGroupIdRequest;
use App\Models\Group;
use App\Services\Attendance\TakeAttendanceService;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    protected $TakeAttendanceService;

    public function __construct(TakeAttendanceService $takeAttendanceService)
    {
        return $this->TakeAttendanceService = $takeAttendanceService;
    }

    public function startGroupAttendance(FindGroupIdRequest $request)
    {
        return $this->TakeAttendanceService->startGroupAttendance($request);
    }
}
