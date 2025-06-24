<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Http\Requests\EmployeeListRequest;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;

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
    function create(EmployeeCreateRequest $request){
        $employee = Employee::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'Employee created successfully.',
        ]);
    }
    function update(EmployeeUpdateRequest $request, $id){
        $employee = Employee::findOrFail($id);
        $employee->update(array_filter($request->validated()));

        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'Employee updated successfully.',
        ]);
    }
    function delete($id){
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully.',
        ]);
    }
}
