<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionAcceptance extends Model
{
    use HasFactory;

    protected $table = 'inspection_and_acceptances';

    public function details()
    {
        return $this->hasMany(InspectionAcceptanceDetail::class, 'iar_id', 'id');
    }

    public function createdBy()
    {
        // return $this->belongsTo(User::class, 'created_by', 'id');
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
