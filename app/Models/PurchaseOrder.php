<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'po_id', 'id');
    }

    public function createdBy()
    {
        // return $this->belongsTo(User::class, 'created_by', 'id');
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'id', 'office_id');
    }

}
