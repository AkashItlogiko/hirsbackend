<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentListRequest;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
  function list(DepartmentListRequest $request){
$searchQuery = $request->input('search', '');
        $department = Department::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('name', 'like', "%$searchQuery%");

                });
            })
             ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

            return  response()->json([
            'success' => true,
            'data' => $department,
            'message' => 'Department list retrieved successfully.',
        ]);
  }

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

    function show($id){
        $department = Department::findOrFail($id);

        return response()->json([
         'success' => true,
         'data' => $department,
         'message' => 'Department details retrieved succesfully.',
        ]);
    }

    function delete($id){
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json([
          'success' =>true,
          'message' =>'Department delete successfully.',
        ]);
    }


}
