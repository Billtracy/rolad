<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date|after:today',
            'message' => 'nullable|string',
        ]);

        $property = Property::findOrFail($validated['property_id']);

        $lead = Lead::create([
            'property_id' => $property->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'type' => 'inspection',
            'preferred_date' => $validated['preferred_date'],
            'message' => $validated['message'],
            'status' => 'new',
            'payment_status' => $property->inspection_fee > 0 ? 'pending' : 'pending', // Or 'not_required'? Let's stick to pending for > 0, maybe 'na' for 0. For now 'pending' is fine if amount is 0.
            'amount_paid' => 0,
        ]);

        if ($property->inspection_fee > 0) {
            return redirect()->route('booking.payment', $lead->id);
        }

        return redirect()->back()->with('success', 'Inspection booked successfully. We will contact you shortly.');
    }

    public function payment($id)
    {
        $lead = Lead::findOrFail($id);

        if ($lead->payment_status === 'paid') {
             return redirect()->route('properties.show', $lead->property->slug)->with('success', 'Payment already completed.');
        }

        $property = $lead->property;

        return view('booking.payment', compact('lead', 'property'));
    }

    public function processPayment(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $property = $lead->property;

        // Simulate successful payment
        $lead->update([
            'payment_status' => 'paid',
            'payment_reference' => 'SIM-' . Str::random(10),
            'amount_paid' => $property->inspection_fee,
        ]);

        return redirect()->route('properties.show', $property->slug)->with('success', 'Payment successful! Your inspection is confirmed.');
    }
}
