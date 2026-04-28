<x-app-layout>
    <x-slot name="header">Process Payment for {{ $booking->customer_name }}</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Service:</strong> {{ $booking->service->name }}</p>
                    <p><strong>Total Amount:</strong> ${{ $booking->total_price }}</p>
                    <form method="POST" action="{{ route('payments.store', $booking) }}">
                        @csrf
                        <div><label>Amount Received</label><input type="number" step="0.01" name="amount" value="{{ $booking->total_price }}" required class="border w-full"></div>
                        <div class="mt-4"><label>Payment Method (optional)</label><input type="text" name="payment_method" class="border w-full" placeholder="Cash, Credit Card..."></div>
                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>