<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CRItems extends Model
{
    protected $fillable = [
        'customer_requirement_id',
        'line_item',
        'quantity',
        'is_price'
    ];

    // public function customerRequirement()
    // {
    //     return $this->belongsTo(CustomerRequirement::class);
    //  }
}
