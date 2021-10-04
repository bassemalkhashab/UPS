<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippedItems extends Model
{
    use HasFactory;

    public function transportationEvent(){
        return $this->belongsToMany(TransportationEvent::class, 'shippings', 'itemNumber', 'scheduleNumber');
    }

    public function retailCenter(){
        return $this-> hasOne(RetailCenter::class);
    }
}
