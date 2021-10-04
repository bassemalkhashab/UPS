<?php

namespace App\Http\Controllers;

use App\Models\ShippedItems;  // Shipped items table
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Http\Requests\createShippedItem;  // Server side validation for submitting new shipped items
use App\Http\Requests\updateShippedItems;  // Server side validation for updating an existing shipped item

class ShippedItemsController extends Controller
{

    // return all shipped items with all details
    public function displayShippedItems()
    {
        $shippedItem = ShippedItems::get();
        return view('shipped-items', compact('shippedItem'));
    }

    // Go to insert shipped items form page
    public function insertShippedItems()
    {
        return view('insert-shipped-items');
    }

    // Insert new shipped item
    public function submitShippedItems(createShippedItem $request)
    {

        $itemNumber = $request->itemNumber;
        $weight = $request->weight;
        $dimension = $request->dimension;
        $insuranceAmount = $request->insuranceAmount;
        $destination = $request->destination;
        $finalDeliveryDate = $request->finalDeliveryDate;
        $shippedItem = new ShippedItems;
        $shippedItem->itemNumber = $itemNumber;
        $shippedItem->weight = $weight;
        $shippedItem->dimensions = $dimension;
        $shippedItem->insuranceAmount = $insuranceAmount;
        $shippedItem->destination = $destination;
        $shippedItem->finalDeliveryDate = $finalDeliveryDate;
        $shippedItem->save();
        return redirect()->back()->with('success', 'Item has been added successfully.');
    }

    // Delete a shipped item
    public function deleteShippedItems($itemNumber)
    {

        $shippedItem = ShippedItems::firstOrFail()->where('itemNumber', $itemNumber);
        $shippedItem->delete();

        return redirect('/shipped-items');
    }

    // return data of a specific shipped item to the update form page
    public function viewShippedItem($itemNumber)
    {

        $shippedItem = ShippedItems::where('itemNumber', $itemNumber)->firstOrFail();

        return view('update-shipped-items', compact('shippedItem'));
    }

    // updating an existing shipped item
    public function updateShippedItem(updateShippedItems $request, $itemNumber)
    {

        ShippedItems::firstOrFail()->where('itemNumber', $itemNumber)->update([
            'itemNumber' => $itemNumber,
            'weight' => $request->weight,
            'dimensions' => $request->dimension,
            'insuranceAmount' => $request->insuranceAmount,
            'destination' => $request->destination,
            'finalDeliveryDate' => $request->finalDeliveryDate
        ]);

        return redirect()->back()->with('success', 'Item updated successfully');
    }
}
