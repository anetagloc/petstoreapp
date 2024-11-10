<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Pet') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1>View Pet</h1>
        <p><strong>ID:</strong> {{ $pet['id'] }}</p>
        <p><strong>Name:</strong> {{ $pet['name'] }}</p>
        <p><strong>Status:</strong> {{ $pet['status'] }}</p>

        <a href="{{ route('pets.edit', ['pet' => $pet['id']]) }}">Edit Pet</a>
        <form method="POST" action="{{ route('pets.destroy', ['pet' => $pet['id']]) }}" style="display:inline;" onsubmit="return confirmDelete();">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Pet</button>
        </form>
    </div>

    <script>
        //i add simple function to confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this pet?');
        }
    </script>
</x-app-layout>
