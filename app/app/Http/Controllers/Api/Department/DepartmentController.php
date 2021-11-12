<?php

namespace App\Http\Controllers\Api\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\EditDepartmentRequest;
use App\Http\Resources\Department\DepartmentCollection;
use App\Services\Department\DepartmentService;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $departments = $this->departmentService->getList();

        return new DepartmentCollection($departments);
    }

    public function store(CreateDepartmentRequest $request)
    {
        $this->departmentService->create($request->toArray());

        return response()->json('Отдел успешно создан!');
    }

    public function show(int $id)
    {
        $department = $this->departmentService->getItem($id);

        return response()->json($department);
    }

    public function update(int $id, EditDepartmentRequest $request)
    {
        $this->departmentService->edit($id, $request->toArray());

        return response()->json('Отдел успешно обновлен!');
    }

    public function destroy(int $id)
    {
        try {
            $this->departmentService->delete($id);
        } catch (\Exception $exception) {
            return response()->json([
                'errors' => [
                    'Отдел не может быть удален! В нем есть сотрудники'
                ]
            ], 422);
        }

        return response()->json('Отдел удален!');
    }
}
