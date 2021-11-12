<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'employees_count' => $item->employees->count(),
                'employees_max_salary' => $item->employees->max('salary'),
            ];
        })->toArray();
    }
}
