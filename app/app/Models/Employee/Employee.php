<?php

namespace App\Models\Employee;

use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Сотрудник компании.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $sex
 * @property float $salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'sex',
        'salary'
    ];
    private $sexNames = [
        'm' => 'Мужской',
        'f' => 'Женский',
    ];

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    public function getSexName(): string
    {
        return $this->sexNames[$this->sex] ?? '';
    }
}
