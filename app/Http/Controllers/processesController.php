<?php

namespace App\Http\Controllers;
use App\Models\ShippedItems;
use App\Models\Shipping;
use App\Models\TransportationEvent;
use App\Models\RetailCenter;
use Illuminate\Http\Request;

class processesController extends Controller
{
    public function displayProcesses(){

        return view('processes');
    }

    // Add a relation between a shipped item and a retail center
    public function receivedAtProcesses(Request $request){
        $checkValue = ShippedItems::where('itemNumber', $request->itemNumber)->firstOrFail();
        if (!$checkValue->uniqueID){
            ShippedItems::firstOrFail()->where('itemNumber', $request->itemNumber)->update([
                'uniqueID' => $request->uniqueID
            ]);
            return redirect()->back()->with('success1', 'Data entered');
        }
        return redirect()->back()->with('failure1', 'A Retail center ID already existing!');
    }

    // Add a relation between a shipped item and a transportation event
    public function transportationMethodProcesses(Request $request){
        ShippedItems::where('itemNumber', $request->itemNumber)->firstOrFail();
        TransportationEvent::where('scheduleNumber', $request->scheduleNumber)->firstOrFail();
        $shipping = new Shipping;
        $shipping->itemNumber = $request->itemNumber;
        $shipping->scheduleNumber = $request->scheduleNumber;
        $shipping->save();
        return redirect()->back()->with('success2', 'Data entered');
    }
}
