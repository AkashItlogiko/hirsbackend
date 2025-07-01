<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    //
    function create(DepartmentCreateRequest $request){
         $department=Department::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $department,
            'message' => 'Department created successfully.',
        ]);
    }

    function update(DepartmentUpdateRequest $request,$id){
     $department = Department::findOrFail($id);
     $department->update(array_filter($request->validated()));

     return response()->json([
        'success' => true,
        'data' => $department,
        'message' => 'Department update successfully.',
     ]);
    }


}
