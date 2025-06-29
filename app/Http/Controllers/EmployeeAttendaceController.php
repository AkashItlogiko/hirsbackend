<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\EmployAttendaceRequest;

class EmployeeAttendaceController extends Controller
{
   function employeeAttendance(EmployAttendaceRequest $request){
        $startDate = Carbon::createFromDate($request->validated('year'), $request->validated('month'))->startOfMonth();

        $endDate = Carbon::createFromDate($request->validated('year'), $request->validated('month'))->endOfMonth();

        $attendances = Attendance::query()
           ->where('id_card_no', $request->validated('id_card_no'))
           ->whereBetween('date', [$startDate, $endDate])->get();

        return response()->json([
            'success' => true,
            'data' => $attendances,
            'message' => 'Employee attendace retrieved successfully.',
        ]);
   }


}
