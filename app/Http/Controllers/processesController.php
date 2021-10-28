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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayProcesses(Request $request)
    {
        $searchValue = $request->get('search');
        $shippedItems = ShippedItems::where('itemNumber', 'LIKE', '%'.$searchValue.'%')
        ->orWhere('itemName', 'LIKE', '%'.$searchValue.'%')
        ->get();
        $retailCenters = RetailCenter::get();
        $transportationEvents = TransportationEvent::get();
        return view('processes', compact('shippedItems', 'retailCenters', 'transportationEvents'));
    }

    public function checkedItems()
    {
        $shippings = Shipping::get();
        return response()->json($shippings);
    }

    public function selectedItems()
    {
        $shippedItems = ShippedItems::get();
        return response()->json($shippedItems);
    }

    public function processes(Request $request, $itemNumber)
    {
        
        
        $transportationEvents = TransportationEvent::get();
        $shippedItems = ShippedItems::where('itemNumber', $request->itemNumber)->get();
       
        $found = false;

        $transportationEventsArr = array();
        foreach ($transportationEvents as $transportationEvent) {

            $transportationEventName = "transportationEvent" . $transportationEvent->scheduleNumber;
            $transportationEventsArr[] = $request->$transportationEventName;
        }

        $Shippings = Shipping::where('itemNumber', $itemNumber)->get();
        // dd($shippings);
        foreach($Shippings as $Shipping){
            $Shipping->delete();
        }

        foreach ($transportationEventsArr as $scheduleNumber) {
                    if ($scheduleNumber != null) {
                        $shipping = new Shipping;
                        $shipping->itemNumber = $itemNumber;
                        $shipping->scheduleNumber = $scheduleNumber;
                        $shipping->save();
                    }
                }

        $retailCenterName = "retailCenter".$itemNumber;
        ShippedItems::where('itemNumber', $itemNumber)->update([
            'uniqueID'=> $request->$retailCenterName
        ]);

        return redirect()->back()->with('success', 'Data entered');
    }

    public function searchItem(Request $request){

        $searchTerm =$request->json('data');
        // dd($searchTerm);
        $result = ShippedItems::where('itemName', 'LIKE', '%'.$searchTerm.'%')
        ->orWhere('itemNumber', 'LIKE', '%'.$searchTerm.'%')
        ->paginate(4)->toArray();
        // dd($result);
        return response()->json($result["data"]);
    }

    // Add a relation between a shipped item and a retail center
    public function receivedAtProcesses(retailCenterRequest $request)
    {
        $shippedItems = ShippedItems::where('itemNumber', $request->itemNumber)->get();
        $retailCenters = RetailCenter::where('uniqueID', $request->uniqueID)->get();

        // Check if entered shipped item ID is found in the database
        if (sizeof($shippedItems) == 0) {
            return redirect()->back()->with('failure', 'Shipped item not found!');
        }

        $checkValue = ShippedItems::where('itemNumber', $request->itemNumber)->firstOrFail();

        // Check if entered retail center ID is found in the database
        if (sizeof($retailCenters) == 0) {
            return redirect()->back()->with('failure', 'Retail center not found!');
        }

        // Check if retail center unique id is found in shipped items table
        if (!$checkValue->uniqueID) {
            // if no retail center id found add the one that came with request
            ShippedItems::firstOrFail()->where('itemNumber', $request->itemNumber)->update([
                'uniqueID' => $request->uniqueID
            ]);
            return redirect()->back()->with('success', 'Data entered');
        }
        // if retail center id found return a message id already existing
        return redirect()->back()->with('failure', 'Data already existing!');
    }

    // Add a relation between a shipped item and a transportation event
    public function transportationMethodProcesses(transportationEventRequest $request)
    {
        $transportationEvents = TransportationEvent::where('scheduleNumber', $request->scheduleNumber)->get();
        $shippedItems = ShippedItems::where('itemNumber', $request->itemNumber)->get();
        $shipping = Shipping::where('itemNumber', $request->itemNumber)->get();

        // Check if data is already existing
        if ($shipping) {
            foreach ($shipping as $shippingItem) {
                if ($request->scheduleNumber == $shippingItem->scheduleNumber) {
                    return redirect()->back()->with('failure', 'Data already existing!');
                }
            }
        }

        // Check if entered shipped item ID is found in the database
        if (sizeof($shippedItems) == 0) {
            return redirect()->back()->with('failure', 'Shipped item not found!');
        }

        // Check if entered transportation event ID is found in the database
        if (sizeof($transportationEvents) == 0) {
            return redirect()->back()->with('failure', 'Transportation method not found!');
        }

        $shipping = new Shipping;
        $shipping->itemNumber = $request->itemNumber;
        $shipping->scheduleNumber = $request->scheduleNumber;
        $shipping->save();
        return redirect()->back()->with('success', 'Data entered');
    }
}
