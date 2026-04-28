<x-app-layout>
    <x-slot name="header">All Bookings</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('bookings.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ New Booking</a>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-center">Customer</th>
                                <th class="px-4 py-2 text-center">Service</th>
                                <th class="px-4 py-2 text-center">Date/Time</th>
                                <th class="px-4 py-2 text-center">Total</th>
                                <th class="px-4 py-2 text-center">Payment Status</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 text-center">{{ $booking->customer_name }}<br><small>{{ $booking->customer_contact }}</small></td>
                                <td class="px-4 py-2 text-center">{{ $booking->service->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $booking->appointment_datetime->format('Y-m-d g:i A') }}</td>
                                <td class="px-4 py-2 text-center">${{ $booking->total_price }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if($booking->payment && $booking->payment->status == 'paid')
                                        <span class="text-green-600">Paid</span>
                                    @else
                                        <span class="text-red-600">Unpaid</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    @if(!$booking->payment || $booking->payment->status != 'paid')
                                        <a href="{{ route('payments.create', $booking) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Process Payment</a>
                                    @endif
                                    <a href="{{ route('bookings.show', $booking) }}" class="text-blue-600">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>