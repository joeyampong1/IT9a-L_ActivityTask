<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">+ Add New Service</a>

                    <table class="min-w-full mt-4 border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center">Name</th>
                                <th class="px-4 py-2 text-center">Price</th>
                                <th class="px-4 py-2 text-center">Duration</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-center">{{ $service->name }}</td>
                                <td class="px-4 py-2 text-center">${{ $service->price }}</td>
                                <td class="px-4 py-2 text-center">{{ $service->duration }}</td>
                                <td>
                                    <a href="{{ route('services.edit', $service) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this service?')">Delete</button>
                                    </form>
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