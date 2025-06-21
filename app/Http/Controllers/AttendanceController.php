<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\AttendanceListRequest;


class AttendanceController extends Controller
{
    function list(AttendanceListRequest $request){
        $searchQuery = $request->input('search', '');
        $attendances = Attendance::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('id_card_no', 'like', "%$searchQuery%")
                      ->orWhere('employee_name', 'like', "%$searchQuery%")
                      ->orWhere('designation', 'like', "%$searchQuery%")
                      ->orWhere('department', 'like', "%$searchQuery%")
                      ->orWhere('date', 'like', "%$searchQuery%")
                      ->orWhere('status', 'like', "%$searchQuery%");
                });
            })
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $attendances,
            'message' => 'Attendance list retrieved successfully.',
        ]);
    }
}
