<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\EditEmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\ListEmployeeResource;
use App\Models\Employee\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('departments')->get();
        return ListEmployeeResource::collection(collect($employees));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = Employee::create(
            $request->except(['departments'])
        );

        if(!empty($request->departments)){
            $employee->departments()->sync($request->departments);
        }

        $employee->save();

        return response()->json($employee);
    }

    public function show(int $id)
    {
        $employee = Employee::findOrFail($id);
        return new EmployeeResource($employee);
    }

    public function update(int $id, EditEmployeeRequest $request)
    {
        $employee = Employee::findOrFail($id);
        $employee->fill($request->except(['departments']));

        if(!empty($request->departments)){
            $employee->departments()->sync($request->departments);
        }

        $employee->save();

        return response()->json('Изменения успешно сохранены!');
    }

    public function destroy(int $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json('Сотрудник успешно удален!');
    }
}
