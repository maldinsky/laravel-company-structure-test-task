<?php

namespace App\Http\Resources\Department;

use App\Models\Department\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class ListDepartmentResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var Department
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'employees_count' => $this->resource->employees->count(),
            'employees_max_salary' => $this->resource->employees->max('salary'),
        ];
    }
}
