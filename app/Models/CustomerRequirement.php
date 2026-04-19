<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRequirement extends Model
{
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'location_id',
        'address',
        'deadline',
        'status',
    ];



    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }

    public function getLineItems()
    {
        return CRItems::where('customer_requirement_id', $this->id)->get();
    }

    public function getOrderNumberAttribute()
    {

        $year = date('y'); // current year in 2 digits
        $month = date('m'); // current month in 2 digits
        $number = str_pad($this->id, 4, '0', STR_PAD_LEFT); // pad your ID to 4 digits

        $code = "RQ-{$year}{$month}-{$number}";
        return $code;
    }

    public function isRead(){
        return ReadItem::where('user_id', auth()->id())->where('item_id', $this->id)->first();
    }
}
