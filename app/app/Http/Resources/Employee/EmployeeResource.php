<?php

namespace App\Http\Resources\Employee;

use App\Models\Employee\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var Employee
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
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'middle_name' => $this->resource->middle_name,
            'sex' => $this->resource->sex,
            'salary' => $this->resource->salary,
            'departments' => $this->resource->departments->pluck('id'),
        ];
    }
}
