
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        {{-- Create animal --}}
                        <div>
                            <h2 class="text-4xl font-semibold mb-4">Create new animal</h2>
                            <form action="{{ route('pets.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                                    <input type="text" name="name" id="name" required 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                                    <select name="status" id="status" required
                                            class="mt-1 mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="available">Available</option>
                                        <option value="pending">Pending</option>
                                        <option value="sold">Sold</option>
                                    </select>
                                </div>
                                <button type="submit" 
                                        class="mb-4 px-6 py-2 bg-blue text-black border border-dark font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition ease-in-out duration-300">
                                    Add Animal
                                </button>
                            </form>
                        </div>

                        <!-- Search animal -->
                        <div>
                            <h2 class="text-2xl font-semibold mb-4">Search for an animal by ID</h2>
                            <form method="GET" action="{{ route('pets.show') }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="petId" class="block text-sm font-medium text-gray-700">ID:</label>
                                    <input type="number" name="petId" id="petId" value="{{ old('petId', 1) }}" required
                                           class="mb-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <button type="submit"
                                class="mb-4 px-6 py-2 bg-blue text-black border border-dark font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition ease-in-out duration-300">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="mt-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mt-8 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <p class="font-bold">Error</p>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>