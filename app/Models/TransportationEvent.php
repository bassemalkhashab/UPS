<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationEvent extends Model
{
    use HasFactory;

    public function shippedItems(){
        return $this->belongsToMany(ShippedItems::class, 'shippings', 'scheduleNumber', 'itemNumber');
    }
}
