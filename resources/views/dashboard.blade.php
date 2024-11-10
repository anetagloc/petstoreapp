<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1>Dashboard</h1>
        
        {{-- Create animal --}}
        <h2>Create new animal</h2>
        <form action="{{ route('pets.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
            <button type="submit">Add</button>
        </form>

        <!-- Search animal -->
        <h2>Search for an animal by ID</h2>
        <form method="GET" action="{{ route('pets.show') }}">
            @csrf
            <label for="petId">ID:</label>
            <input type="number" name="petId" id="petId" value="{{ old('petId', 1) }}" required>
            <button type="submit">Search</button>
        </form>
   

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
