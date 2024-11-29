@extends('layouts.layout')

@section('title', 'Edit Property')

@section('content')
<div class="container mx-auto py-10">
    <h2 class="text-3xl font-bold mb-6">Edit Property</h2>
    
    <!-- Display errors -->
    <div>
        @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    
    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="p-6 rounded shadow-lg">
        @csrf
        @method('PUT')
        
        <!-- Image -->
        <div class="form-control mb-4">
            <label class="label">Image</label>
            <input type="file" name="image" class="file-input file-input-bordered" />
            @if($property->image_path)
                <img src="{{ asset('storage/' . $property->image_path) }}" alt="Current Property Image" class="mt-4 w-32 h-32 object-cover"/>
            @endif
        </div>

        <!-- Title -->
        <div class="form-control mb-4">
            <label class="label">Title</label>
            <input type="text" name="title" class="input input-bordered" required value="{{ old('title', $property->title) }}" />
        </div>

        <!-- Description -->
        <div class="form-control mb-4">
            <label class="label">Description</label>
            <textarea name="description" class="textarea textarea-bordered" required>{{ old('description', $property->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="form-control mb-4">
            <label class="label">Price</label>
            <input type="text" name="price" class="input input-bordered" required value="{{ old('price', $property->price) }}" />
        </div>

        <!-- Type -->
        <div class="form-control mb-4">
            <label class="label">Type</label>
            <select name="type" class="select select-bordered" required>
                <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>House</option>
                <option value="condo" {{ old('type', $property->type) == 'condo' ? 'selected' : '' }}>Condo</option>
            </select>
        </div>

        <!-- Wi-Fi Available -->
        <div class="form-control mb-4">
            <label class="label cursor-pointer">
                <span class="label-text">Wi-Fi Available</span>
                <input type="checkbox" name="wifi_available" class="toggle toggle-primary" {{ old('wifi_available', $property->wifi_available) ? 'checked' : '' }} />
            </label>
        </div>

        <!-- Location -->
        <div class="form-control mb-4">
            <label class="label">Location</label>
            <input type="text" name="location" class="input input-bordered" required value="{{ old('location', $property->location) }}" />
        </div>
        
        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection
