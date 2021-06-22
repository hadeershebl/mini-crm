<?php

namespace App\Models\Company;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // start relationships

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }

    // end relationships
}
