<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    public function details()
    {
        return $this->hasMany(RequisitionDetail::class, 'ris_id', 'id');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'id', 'office_id');
    }

    public function requisitioner()
    {
        return $this->hasOne(User::class, 'id', 'requested_by');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function issuedBy()
    {
        return $this->hasOne(User::class, 'id', 'issued_by');
    }

    public function receivedBy()
    {
        return $this->hasOne(User::class, 'id', 'received_by');
    }

}
