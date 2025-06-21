<?php

namespace App\Http\Controllers;
use App\Http\Requests\EmployeeListRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    function list(EmployeeListRequest $request){
        $searchQuery = $request->input('search', '');
        $employees = Employee::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('employee_name', 'like', "%$searchQuery%")
                      ->orWhere('department', $searchQuery)
                      ->orWhere('id_card_number', 'like', "%$searchQuery%")
                      ->orWhere('designation', 'like', "%$searchQuery%")
                      ->orWhere('email', 'like', "%$searchQuery%")
                      ->orWhere('phone_number', 'like', "%$searchQuery%")
                      ->orWhere('address', 'like', "%$searchQuery%");
                });
            })
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $employees,
            'message' => 'Employee list retrieved successfully.',
        ]);
    }
}
