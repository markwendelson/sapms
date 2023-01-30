<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionAcceptanceDetail extends Model
{
    use HasFactory;

    protected $table = 'inspection_and_acceptance_details';

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }

}
