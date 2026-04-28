<x-app-layout>
    <x-slot name="header">Create New Booking</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div><label>Customer Name</label><input type="text" name="customer_name" required class="border w-full"></div>
                        <div class="mt-4"><label>Contact No.</label><input type="text" name="customer_contact" required class="border w-full"></div>
                        <div class="mt-4">
                            <label>Select Service</label>
                            <select name="service_id" class="border w-full" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} - ${{ $service->price }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4"><label>Appointment Date & Time</label><input type="datetime-local" name="appointment_datetime" required class="border w-full"></div>
                        <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2">Save Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>