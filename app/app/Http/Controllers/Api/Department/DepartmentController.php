<?php

namespace App\Http\Controllers\Api\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\EditDepartmentRequest;
use App\Http\Resources\Department\ListDepartmentResource;
use App\Models\Department\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('employees')->get();

        return ListDepartmentResource::collection(collect($departments));
    }

    public function store(CreateDepartmentRequest $request)
    {
        $department = new Department([
            'name' => $request->input('name'),
        ]);
        $department->save();

        return response()->json('Отдел успешно создан!');
    }

    public function show(int $id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(int $id, EditDepartmentRequest $request)
    {
        $department = Department::findOrFail($id);
        $department->update($request->all());

        return response()->json('Отдел успешно обновлен!');
    }

    public function destroy(int $id)
    {
        $department = Department::findOrFail($id);

        if($department->employees->count()) {
            return response()->json([
                'errors' => [
                    'Отдел не может быть удален! В нем есть сотрудники'
                ]
            ], 422);
        }

        $department->delete();

        return response()->json('Отдел удален!');
    }
}
