<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\EditEmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\ListEmployeeResource;
use App\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getList();
        return ListEmployeeResource::collection(collect($employees));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = $this->employeeService->create($request->toArray());

        return response()->json($employee);
    }

    public function show(int $id)
    {
        $employee = $this->employeeService->getItem($id);

        return new EmployeeResource($employee);
    }

    public function update(int $id, EditEmployeeRequest $request)
    {
        $this->employeeService->edit($id, $request->toArray());

        return response()->json('Изменения успешно сохранены!');
    }

    public function destroy(int $id)
    {
        $this->employeeService->delete($id);

        return response()->json('Сотрудник успешно удален!');
    }
}
