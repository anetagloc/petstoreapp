
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold mb-6">Pet Details</h1>

                    <div class="bg-gray-100 p-6 rounded-lg mb-6">
                        <p class="mb-2"><span class="font-semibold">ID:</span> {{ $pet['id'] }}</p>
                        <p class="mb-2"><span class="font-semibold">Name:</span> {{ $pet['name'] }}</p>
                        <p class="mb-2">
                            <span class="font-semibold">Status:</span> 
                            <span class="px-3 py-1 inline-flex text-sm leading-5
                                {{ $pet['status'] === 'available' ? 'bg-green-100 text-green-800' : 
                                   ($pet['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($pet['status']) }}
                            </span>
                        </p>
                    </div>

                    <div class="flex space-x-8">
                        <a href="{{ route('pets.edit', ['pet' => $pet['id']]) }}" 
                            class="mb-4 px-6 py-2 bg-blue text-black border border-dark font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition ease-in-out duration-300">
                            Edit Pet
                        </a>
                        <form method="POST" action="{{ route('pets.destroy', ['pet' => $pet['id']]) }}" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="mb-4 px-6 py-2 bg-blue text-black border border-dark font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition ease-in-out duration-300">
                                Delete Pet
                            </button>
                        </form>
                        <a href="{{ route('dashboard') }}" 
                        class="mb-4 px-6 py-2 bg-grey text-black border border-dark font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition ease-in-out duration-300">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this pet? This action cannot be undone.');
        }
    </script>
</x-app-layout>