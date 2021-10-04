<?php

namespace App\Http\Controllers;

use App\Models\RetailCenter;
use App\Http\Requests\createRetailCenter;
use App\Http\Requests\updateRetailCenter;
use Illuminate\Http\Request;

class retailCenterController extends Controller
{

    // Display all retail centers on a table
    public function displayRetailCenter()
    {

        $retailCenters = RetailCenter::get();
        return view('retail-center', compact('retailCenters'));
    }

    // Redirect to insert retail form
    public function insertRetailCenter()
    {
        return view('insert-retail-center');
    }

    // Submit form to create a new retail center
    public function SubmitRetailCenter(createRetailCenter $request)
    {

        $retailCenter = new RetailCenter;

        $retailCenter->uniqueID = $request->uniqueID;
        $retailCenter->type = $request->type;
        $retailCenter->address = $request->address;

        $retailCenter->save();

        return redirect()->back()->with('success', 'Item has been added successfully');
    }

    // Delete a retail center by its unique ID
    public function deleteRetailCenter($uniqueID)
    {

        $retailCenter = RetailCenter::firstOrFail()->where('uniqueID', $uniqueID);
        $retailCenter->delete();
        return redirect('/retail-center');
    }

    // View a form with a certain retail center to edit it
    public function viewRetailCenter($uniqueID)
    {

        $retailCenter = RetailCenter::where('uniqueID', $uniqueID)->firstOrFail();
        return view('update-retail-center', compact('retailCenter'));
    }

    // Submit form to update retail center
    public function updateRetailCenter(updateRetailCenter $request, $uniqueID)
    {

        RetailCenter::firstOrFail()->where('uniqueID', $uniqueID)->update([

            'type' => $request->type,
            'address' => $request->address

        ]);
        return redirect()->back()->with('success', 'Item updated successfully');
    }
}
