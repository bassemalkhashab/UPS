<?php

namespace App\Http\Controllers;
use App\Models\TransportationEvent;
use App\Http\Requests\createTransportationEvent;
use App\Http\Requests\updateTransportationEvent;
use Illuminate\Http\Request;

class transportationEventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Return all data about transportation event to a table
    public function displayTransportationEvent()
    {
        $transportationEvents = TransportationEvent::get();
        return view('transportation-event', compact('transportationEvents'));
    }

    // Redirect to a form page to insert a transportation event
    public function insertTransportationEvent()
    {
        return view('insert-transportation-event');
    }

    // Insert a new transportation event
    public function submitTransportationEvent(createTransportationEvent $request){

        $transportationEvent = new TransportationEvent;
        $transportationEvent->scheduleNumber = $request-> scheduleNumber;
        $transportationEvent->type = $request-> type;
        $transportationEvent->deliveryRoute = $request-> deliveryRoute;
        $transportationEvent->save();
        return redirect()->back()->with('success', 'Item has been added successfully');
    }

    // Delete a transportation event
    public function deleteTransportationEvent($scheduleNumber){

        $transportationEvent = TransportationEvent::firstOrFail()->where('scheduleNumber', $scheduleNumber);
        $transportationEvent->delete();

        return redirect('/transportation-event');
    }

    // Redirect to a form page with data about transportation event to update it
    public function viewTransportationEvent($scheduleNumber){

        $transportationEvent = TransportationEvent::where('scheduleNumber', $scheduleNumber)->firstOrFail();

        return view('update-transportation-event', compact('transportationEvent'));
    }

    // update a transportation event
    public function updateTransportationEvent(updateTransportationEvent $request, $scheduleNumber){

        TransportationEvent::firstOrFail()->where('scheduleNumber', $scheduleNumber)->update([
            'scheduleNumber'=> $scheduleNumber,
            'type'=> $request->type,
            'deliveryRoute' => $request->deliveryRoute
        ]);

        return redirect()->back()->with('success', 'Item has been updated successfully');
    }
}
