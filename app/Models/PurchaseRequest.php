<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public function details()
    {
        return $this->hasMany(PurchaseRequestDetail::class, 'pr_id', 'id');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'id', 'office_id');
    }

    public function requisitioner()
    {
        return $this->hasOne(User::class, 'id', 'requested_by');
    }
}
