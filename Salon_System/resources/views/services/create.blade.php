<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('services.store') }}">
                        @csrf

                        <!-- Service Name -->
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Service Name</label>
                            <input id="name" type="text" name="name" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <label for="price" class="block font-medium text-sm text-gray-700">Price</label>
                            <input id="price" type="number" step="0.01" name="price" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        </div>

                        <!-- Duration -->
                        <div class="mt-4">
                            <label for="duration" class="block font-medium text-sm text-gray-700">Duration (e.g., 30 mins, 1 hour)</label>
                            <input id="duration" type="text" name="duration" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Save Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>