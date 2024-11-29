@extends('layouts.layout')

@section('title', 'Home') 

@section('content')
<h1 class="text-4xl font-bold text-center mb-6">Explore Our Properties</h1>
<div>
    @if(session()->has('success'))
        <div class="alert alert-success mb-3">
            {{session('success')}}
        </div>
    @endif
</div>


<!-- Property Type Filter -->
<div class="mt-6 flex gap-4">
    <form method="GET" action="{{ route('properties.index') }}" class="w-full max-w-xs">
        <select name="type" class="select select-bordered w-full" onchange="this.form.submit()">
            <option value="">All Types</option>
            <option value="apartment" @if(request('type') === 'apartment') selected @endif>Apartment</option>
            <option value="house" @if(request('type') === 'house') selected @endif>House</option>
            <option value="condo" @if(request('type') === 'condo') selected @endif>Condo</option>
        </select>
    </form>

    <!-- Wi-Fi Availability Filter -->
    <form method="GET" action="{{ route('properties.index') }}" class="flex items-center">
        <input type="hidden" name="type" value="{{ request('type') }}">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="wifi_available" value="1" class="checkbox checkbox-primary"
                onchange="this.form.submit()" {{ request('wifi_available') ? 'checked' : '' }} />
            <span>Wi-Fi Available</span>
        </label>
    </form>
</div>



<!-- Property List -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8 px-4">
    @foreach($properties as $property)
        <div class="card shadow-xl rounded-lg overflow-hidden">
            <div class="card-body p-4">
                @if($property->image_path)
                    <figure class="mb-4">
                        <img src="{{ asset('storage/' . $property->image_path) }}" alt="{{ $property->title }}"
                            class="w-full h-48 object-cover">
                    </figure>
                @endif
                <h2 class="card-title text-xl font-semibold mb-2">{{ $property->title }}</h2>
                <p class="text-s mb-4">{{ $property->description }}</p>
                <p class="text-lg font-bold ">${{ number_format($property->price, 2) }}</p>
                <p class="text-sm "><strong>Wi-Fi Available:</strong> {{ $property->wifi_available ? 'Yes' : 'No' }}</p>
                <p class="text-sm "><strong>Type:</strong> {{ ucfirst($property->type) }}</p>
                <div class="card-actions   mt-4">
                    <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary text-sm">View</a>
                    <button type="button" class="btn btn-error text-sm"
                        onclick="confirmDelete({{ $property->id }})">Delete
                    <button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Confirmation Dialog Box -->
<div id="deleteConfirmationModal"
    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center opacity-0 pointer-events-none transition-all duration-300 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 opacity-0 transform scale-95 transition-all duration-300">
        <h3 class="text-xl font-semibold mb-4">Are you sure you want to delete this property?</h3>
        <div class="flex justify-end space-x-4">
            <button id="cancelDelete" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(propertyId) {

        const form = document.getElementById('deleteForm');
        form.action = '/properties/' + propertyId;

        const modal = document.getElementById('deleteConfirmationModal');
        modal.classList.remove('hidden');

        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            modal.querySelector('.bg-white').classList.add('opacity-100', 'transform', 'scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        // Hide the confirmation modal 
        const modal = document.getElementById('deleteConfirmationModal');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modal.querySelector('.bg-white').classList.remove('opacity-100', 'transform', 'scale-100');
        modal.querySelector('.bg-white').classList.add('opacity-0', 'transform', 'scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.add('pointer-events-none');
        }, 300);
    }
</script>
@endsection