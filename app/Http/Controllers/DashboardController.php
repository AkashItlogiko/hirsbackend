<?php

namespace App\Http\Controllers;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use App\Http\Requests\AttendanceCountRequest;

class DashboardController extends Controller
{
    function allEmployeeCount()
    {
        $allEmployeeCount = Employee::all()->count();

        return response()->json([
            'success' => true,
            'data' => $allEmployeeCount,
            'message' => 'All employee count retrieved successfully.',
        ]);
    }

    function totalSalary()
    {
        $totalSalary = Salary::sum('net_salary');

        return response()->json([
            'success' => true,
            'data' => $totalSalary,
            'message' => 'Total salary retrieved successfully.',
        ]);
    }
    function totalAttendance(AttendanceCountRequest $request)
    {
        $totalAttendance = Attendance::count();
        if ($request->has('status')) {
            $status = $request->input('status');
            $totalAttendance = Attendance::where('status', $status)->count();
        }
        return response()->json([

            'success' => true,
            'data' => $totalAttendance,
            'message' => 'Total attendance retrieved successfully.',
        ]);
    }

}
