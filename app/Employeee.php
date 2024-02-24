<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'name',
    ];

}
