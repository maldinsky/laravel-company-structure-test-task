<?php

namespace App\Models\Department;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Отдел компании.
 *
 * @property int $id
 * @property string $name
 */
class Department extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
