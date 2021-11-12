<?php

namespace App\Services\Employee;

use App\Models\Employee\Employee;

class EmployeeService
{
    public function getItem(int $id)
    {
        return Employee::findOrFail($id);
    }

    public function getList()
    {
        return Employee::with('departments')->get();
    }

    public function create(array $employeeData): Employee
    {
        $employee = Employee::create($employeeData);

        if(!empty($employeeData['departments'])){
            $employee->departments()->sync($employeeData['departments']);
        }

        $employee->save();

        return $employee;
    }

    public function edit(int $id, array $employeeData): Employee
    {
        $employee = Employee::findOrFail($id);
        $employee->fill($employeeData);

        if(!empty($employeeData['departments'])){
            $employee->departments()->sync($employeeData['departments']);
        }

        $employee->save();

        return $employee;
    }

    public function delete(int $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }
}
