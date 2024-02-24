<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewEmployeeTransfer extends Model
{
    protected $table = 'new_emplyoee_transfers';
    protected $fillable = [
        'employee_id', 'employee_code', 'designation_id', 'old_district_id', 'old_block_id', 'old_gram_panchayat_id', 'new_district_id', 'new_block_id', 'new_gram_panchayat_id', 'status', 'remarks',
    ];
}
