<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'middle_name' => $item->middle_name,
                'sex' => $item->getSexName(),
                'salary' => $item->salary,
                'departments' => $item->departments->toArray(),
            ];
        })->toArray();
    }
}
