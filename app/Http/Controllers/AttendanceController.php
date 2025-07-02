<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Http\Requests\AttendanceListRequest;
use App\Http\Requests\AttendanceCreateRequest;
use App\Http\Requests\AttendanceUpdateRequest;


class AttendanceController extends Controller
{
    function list(AttendanceListRequest $request){
        $searchQuery = $request->input('search', '');


        $attendances = Attendance::query()->with('employee.department')
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

             ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $attendances,
            'message' => 'Attendance list retrieved successfully.',
        ]);
    }

    function create(AttendanceCreateRequest $request)
    {
    foreach ($request->validated() as $item) {
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $item['employee_id'],
                'date' => $item['date'],
            ],
            ['status' => $item['status']]
        );
    }

        return response()->json([
            'success' => true,
            'data' => $attendance,
            'message' => 'Attendance created successfully.',
        ]);
    }

    function update(AttendanceUpdateRequest $request, $id){
        $attendance = Attendance::findOrFail($id);
        $attendance->update (array_filter($request->validated()));
        return response()->json([
            'success' => true,
            'data' => $attendance,
            'message' => 'Attendance updated successfully.',
        ]);
    }

    function show($id){
        $attendance = Attendance::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $attendance,
            'message' => 'Attendance details retrieved successfully.',
        ]);
    }
    function delete($id){
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attendance deleted successfully.',
        ]);
    }
}
