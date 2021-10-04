<?php

namespace App\Http\Controllers;
use App\Models\ShippedItems;
use App\Models\Shipping;
use App\Models\TransportationEvent;
use Illuminate\Http\Request;

class homeController extends Controller
{
    // Send data with all relations to the home page
    public function displayHomePage(){
        
        $shippedItems = ShippedItems::select('shipped_items.itemNumber', 'shipped_items.uniqueID', 'shippings.scheduleNumber')
        ->leftJoin('shippings', 'shipped_items.itemNumber', '=', 'shippings.itemNumber')
        ->orderBy('shipped_items.itemNumber')
        ->get();
        // return dd($shippedItems);
        return view('home', compact('shippedItems'));
    }

    // Remove relation between a shipped item and a retail center
    public function deleteUniqueID($uniqueID, $itemNUmber){

        $retailCenter = ShippedItems::where('uniqueID', $uniqueID)->where('itemNUmber', $itemNUmber)->update([
            'uniqueID'=> NULL
        ]);
        
        return redirect('/');
    }
    
    // Remove a relation between a shipped item and a transportation event
    public function deleteScheduleNumber($scheduleNumber, $itemNUmber){
        
        $transportationEvent = Shipping::where('scheduleNumber', $scheduleNumber)->where('itemNUmber', $itemNUmber)->delete();
        return redirect('/');
    }
}
