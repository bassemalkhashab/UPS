<?php

namespace App\Http\Controllers;

use App\Models\ShippedItems;
use App\Models\Shipping;
use App\Models\TransportationEvent;
use App\Models\RetailCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class homeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Send data with all relations to the home page
    public function displayHomePage()
    {

        $name = Auth::user()->firstName;
        $retailCenters = RetailCenter::get();
        $shippings = Shipping::select('shippings.itemNumber', 'transportation_events.type', 'transportation_events.deliveryRoute')
            ->leftJoin('transportation_events', 'shippings.scheduleNumber', 'transportation_events.scheduleNumber')
            ->get()->toArray();
        $ShippedItems = ShippedItems::select('shipped_items.itemNumber', 'shipped_items.image', 'shipped_items.itemName', 'shipped_items.uniqueID', 'shipped_items.finalDeliveryDate', 'retail_centers.address', 'retail_centers.type')
            // $shippedItems = ShippedItems::select('shipped_items.itemNumber', 'shipped_items.image', 'shipped_items.itemName' , 'shipped_items.uniqueID', 'shipped_items.finalDeliveryDate' , 'shippings.scheduleNumber', 'retail_centers.address', 'retail_centers.type')
            // ->leftJoin('shippings', 'shipped_items.itemNumber', '=', 'shippings.itemNumber')
            ->leftJoin('retail_centers', 'shipped_items.uniqueID', '=', 'retail_centers.uniqueID')
            ->orderBy('shipped_items.itemNumber')
            // ->get()
            ->paginate(8)
            ->toArray();
        // dd($shippedItems);
        $shippedItems = $this->reformatingShippedItems($ShippedItems["data"], $shippings);
        // return dd($retailCenters);  
        $requestedRetailCenter = null;
        $lastPage = $ShippedItems["last_page"];
        $currentPage = $ShippedItems["current_page"];
        if ($currentPage < $lastPage) {
            $next = $currentPage + 1;
        } else {
            $next = $lastPage;
        }
        if ($currentPage > 1) {
            $previous = $currentPage - 1;
        } else {
            $previous = 1;
        }
        return view('home', compact('shippedItems', 'name', 'retailCenters', 'requestedRetailCenter', 'lastPage', 'next', 'previous'));
    }

    public function filterByRetailCenter($uniqueID)
    {

        $name = Auth::user()->firstName;
        $retailCenters = RetailCenter::get();
        $shippings = Shipping::select('shippings.itemNumber', 'transportation_events.type', 'transportation_events.deliveryRoute')
            ->leftJoin('transportation_events', 'shippings.scheduleNumber', 'transportation_events.scheduleNumber')
            ->get()->toArray();
        $ShippedItems = ShippedItems::select('shipped_items.itemNumber', 'shipped_items.image', 'shipped_items.itemName', 'shipped_items.uniqueID', 'shipped_items.finalDeliveryDate', 'retail_centers.address', 'retail_centers.type')
            // $shippedItems = ShippedItems::select('shipped_items.itemNumber', 'shipped_items.image', 'shipped_items.itemName' , 'shipped_items.uniqueID', 'shipped_items.finalDeliveryDate' , 'shippings.scheduleNumber', 'retail_centers.address', 'retail_centers.type')
            // ->leftJoin('shippings', 'shipped_items.itemNumber', '=', 'shippings.itemNumber')
            ->leftJoin('retail_centers', 'shipped_items.uniqueID', '=', 'retail_centers.uniqueID')
            ->where('retail_centers.uniqueID', $uniqueID)
            ->orderBy('shipped_items.itemNumber')
            ->paginate(8)
            ->toArray();
        $shippedItems = $this->reformatingShippedItems($ShippedItems["data"], $shippings);
        // return dd($request->retailCenter);  
        $requestedRetailCenter = $uniqueID;
        $lastPage = $ShippedItems["last_page"];
        $currentPage = $ShippedItems["current_page"];
        if ($currentPage < $lastPage) {
            $next = $currentPage + 1;
        } else {
            $next = $lastPage;
        }
        if ($currentPage > 1) {
            $previous = $currentPage - 1;
        } else {
            $previous = 1;
        }
        return view('home', compact('shippedItems', 'name', 'retailCenters', 'requestedRetailCenter', 'lastPage', 'next', 'previous'));
    }

    private function reformatingShippedItems($shippedItems, $shippings)
    {
        foreach ($shippedItems as $index => $shippedItem) {
            foreach ($shippings as $shipping) {
                if ($shippedItem['itemNumber'] == $shipping['itemNumber']) {

                    $shippedItems[$index]['transportationEvents'][] = $shipping;
                }
                // dd($shippedItem);
            }
        }
        return collect($shippedItems);
    }

    // Remove relation between a shipped item and a retail center
    public function deleteUniqueID($uniqueID, $itemNUmber)
    {

        $retailCenter = ShippedItems::where('uniqueID', $uniqueID)->where('itemNUmber', $itemNUmber)->update([
            'uniqueID' => NULL
        ]);

        return redirect('/');
    }

    // Remove a relation between a shipped item and a transportation event
    public function deleteScheduleNumber($scheduleNumber, $itemNUmber)
    {

        $transportationEvent = Shipping::where('scheduleNumber', $scheduleNumber)->where('itemNUmber', $itemNUmber)->delete();
        return redirect('/');
    }
}
