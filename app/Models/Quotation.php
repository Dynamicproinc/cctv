<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
    'customer_requirement_id',
    'user_id',
    'supplier_id',
    'price',
    'discount',
    'status',
    'note',
];

    public function customerRequirement()
    {
        return $this->belongsTo(CustomerRequirement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
