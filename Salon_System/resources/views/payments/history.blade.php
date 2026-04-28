<x-app-layout>
    <x-slot name="header">Payment Transactions History</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                            <th class="px-4 py-2 text-center">Booking ID</th>
                            <th class="px-4 py-2 text-center">Customer</th>
                            <th class="px-4 py-2 text-center">Service</th>
                            <th class="px-4 py-2 text-center">Amount</th>
                            <th class="px-4 py-2 text-center">Payment Date</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Method</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td class="px-4 py-2 text-center">{{ $payment->booking_id }}</td>
                                <td class="px-4 py-2 text-center">{{ $payment->booking->customer_name }}</td>
                                <td class="px-4 py-2 text-center">{{ $payment->booking->service->name }}</td>
                                <td class="px-4 py-2 text-center">${{ $payment->amount }}</td>
                                <td class="px-4 py-2 text-center">{{ $payment->payment_date->format('Y-m-d H:i') }}</td>
                                <td class="text-green-600 text-center">{{ ucfirst($payment->status) }}</td>
                                <td class="px-4 py-2 text-center">{{ $payment->payment_method ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
