<?php

namespace App\Http\Controllers;

use App\Http\Requests\retailCenterRequest;
use App\Http\Requests\transportationEventRequest;
use App\Models\ShippedItems;
use App\Models\Shipping;
use App\Models\TransportationEvent;
use App\Models\RetailCenter;
use Illuminate\Http\Request;

class processesController extends Controller
{
    public function displayProcesses()
    {

        return view('processes');
    }

    // Add a relation between a shipped item and a retail center
    public function receivedAtProcesses(retailCenterRequest $request)
    {
        $checkValue = ShippedItems::where('itemNumber', $request->itemNumber)->firstOrFail();
        // Check if retail center unique id is found in shipped items table
        if (!$checkValue->uniqueID) {
            // if no retail center id found add the one that came with request
            ShippedItems::firstOrFail()->where('itemNumber', $request->itemNumber)->update([
                'uniqueID' => $request->uniqueID
            ]);
            return redirect()->back()->with('success', 'Data entered');
        }
        // if retail center id found return a message id already existing
        return redirect()->back()->with('failure', 'A Retail center ID already existing!');
    }

    // Add a relation between a shipped item and a transportation event
    public function transportationMethodProcesses(transportationEventRequest $request)
    {
        $shippedItems = ShippedItems::where('itemNumber', $request->itemNumber)->firstOrFail();
        $transportationEvents = TransportationEvent::where('scheduleNumber', $request->scheduleNumber)->firstOrFail();
        $shipping = Shipping::where('itemNumber', $request->itemNumber)->get();

        if ($shipping){
            foreach($shipping as $shippingItem){
                if ($request->scheduleNumber == $shippingItem->scheduleNumber) {
                    return redirect()->back()->with('failure', 'Data already existing!');
                }
            }
        }
        

        $shipping = new Shipping;
        $shipping->itemNumber = $request->itemNumber;
        $shipping->scheduleNumber = $request->scheduleNumber;
        $shipping->save();
        return redirect()->back()->with('success', 'Data entered');
    }
}
