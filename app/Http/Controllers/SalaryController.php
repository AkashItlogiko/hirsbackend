<?php

namespace App\Http\Controllers;
use App\Models\Salary;
use App\Http\Requests\SalaryListRequest;
use App\Http\Requests\SalaryCreateRequest;


class SalaryController extends Controller
{
    function list(SalaryListRequest $request)
    {
        $searchQuery = $request->input('search', '');
        $salaries = Salary::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('id_card_no', 'like', "%$searchQuery%")
                      ->orWhere('employee_name', 'like', "%$searchQuery%")
                      ->orWhere('designation', 'like', "%$searchQuery%")
                      ->orWhere('department', 'like', "%$searchQuery%")
                      ->orWhere('net_salary', 'like', "%$searchQuery%")
                      ->orWhere('pay_date', 'like', "%$searchQuery%");
                });
            })
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $salaries,
            'message' => 'Salary list retrieved successfully.',
        ]);
    }
     function create(SalaryCreateRequest $request){
        $employee = Salary::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $salaries,
            'message' => 'Salary created successfully.',
        ]);
    }
}
