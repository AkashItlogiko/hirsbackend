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
        $employees = Employee::query()->with(['attendances', 'department'])
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('employee_name', 'like', "%$searchQuery%")
                      ->orWhere('department', $searchQuery)
                      ->orWhere('id_card_number', 'like', "%$searchQuery%")
                      ->orWhere('nid_number', 'like', "%$searchQuery%")
                      ->orWhere('designation', 'like', "%$searchQuery%")
                      ->orWhere('email', 'like', "%$searchQuery%")
                      ->orWhere('phone_number', 'like', "%$searchQuery%")
                      ->orWhere('present_address', 'like', "%$searchQuery%")
                      ->orWhere('permanent_address', 'like', "%$searchQuery%");
                });
            })
            ->when($request->validated('department_id'), function ($query, $departmentId) {
                $query->whereHas('department', function ($query) use ($departmentId) {
                    $query->where('id', $departmentId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $employees,
            'message' => 'Employee list retrieved successfully.',
        ]);
    }
function create(EmployeeCreateRequest $request){

   if ($request->hasFile('profile_photo')) {
    $image = $request->file('profile_photo');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $requestData = $request->validated();
    $requestData['profile_photo'] = $imageName;

    $image->move(public_path('employees'), $imageName);
} else {
    $requestData = $request->validated();
}

$employee = Employee::create($requestData);

return response()->json([
    'success' => true,
    'data' => $employee,
    'message' => 'Employee created successfully.',
]);
}
    public function update(EmployeeUpdateRequest $request, $id)
{
    $employee = Employee::findOrFail($id);


    $data = $request->validated();

    if ($request->hasFile('image')) {

        if ($employee->image && file_exists(public_path('uploads/employees/' . $employee->image))) {
            unlink(public_path('uploads/employees/' . $employee->image));
        }


        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/employees'), $imageName);


        $data['image'] = $imageName;
    }


    $employee->update($data);

    return response()->json([
        'success' => true,
        'data' => $employee,
        'message' => 'Employee updated successfully with image.',
    ]);
}


    function show($id){
        $employee = Employee::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'Employee details retrieved successfully.',
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
