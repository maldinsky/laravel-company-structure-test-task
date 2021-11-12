<?php

namespace App\Services\Department;

use App\Models\Department\Department;

class DepartmentService
{
    public function getItem(int $id): Department
    {
        return Department::findOrFail($id);
    }

    public function getList()
    {
        return Department::with('employees')->get();
    }

    public function create(array $departmentData): Department
    {
        return Department::create($departmentData);
    }

    public function edit(int $id, array $departmentData): Department
    {
        $department = Department::findOrFail($id);
        $department->update($departmentData);

        return $department;
    }

    public function delete(int $id): void
    {
        $department = Department::findOrFail($id);

        if($department->employees()->exists()) {
            throw new \Exception('Отдел не может быть удален! В нем есть сотрудники');
        }

        $department->delete();
    }
}
