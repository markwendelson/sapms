<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public function officer()
    {
        return $this->belongsTo(\App\Models\User::class,'officer_in_charge','id');
    }
}
