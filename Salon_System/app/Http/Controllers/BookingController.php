<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function index()
    {
        $bookings = Booking::with('service', 'payment')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = Service::all();
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:20',
            'appointment_datetime' => 'required|date',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $validated['total_price'] = $service->price;

        $booking = Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created. Please process payment later.');
    }

    public function show(Booking $booking)
    {
        $booking->load('service', 'payment');
        return view('bookings.show', compact('booking'));
    }

    // For delete if needed
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted.');
    }
}