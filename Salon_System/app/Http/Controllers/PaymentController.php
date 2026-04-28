<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    // Show form to process payment for a specific booking
    public function create(Booking $booking)
    {
        return view('payments.create', compact('booking'));
    }

    // Store payment record
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:50',
        ]);

        // Check if already paid
        if ($booking->payment && $booking->payment->status === 'paid') {
            return redirect()->route('bookings.index')->with('error', 'Booking already paid.');
        }

        Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'amount' => $request->amount,
                'payment_date' => now(),
                'status' => 'paid',
                'payment_method' => $request->payment_method,
            ]
        );

        return redirect()->route('bookings.index')->with('success', 'Payment recorded. Booking is now PAID.');
    }

    // Payment history list
    public function history()
    {
        $payments = Payment::with('booking.service')->latest()->get();
        return view('payments.history', compact('payments'));
    }
}