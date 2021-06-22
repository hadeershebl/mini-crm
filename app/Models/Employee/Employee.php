<?php

namespace App\Models\Employee;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // end relationships

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
