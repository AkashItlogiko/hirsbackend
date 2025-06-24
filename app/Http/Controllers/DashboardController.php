<?php

namespace App\Http\Controllers;
use App\Models\Employee;

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

}
