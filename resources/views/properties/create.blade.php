@extends('layouts.layout')

@section('title', 'Add Property')

@section('content')
<div class="container mx-auto py-10">
    <h2 class="text-3xl font-bold mb-6">Add New Property</h2>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-white font-semibold">{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data"
        class="p-6 rounded shadow-lg">
        @csrf

        <div class="form-control mb-4">
            <label class="label">Image</label>
            <input type="file" name="image" class="file-input file-input-bordered" />
        </div>

        <div class="form-control mb-4">
            <label class="label">Title</label>
            <input type="text" name="title" class="input input-bordered" required />
        </div>

        <div class="form-control mb-4">
            <label class="label">Description</label>
            <textarea name="description" class="textarea textarea-bordered" required></textarea>
        </div>

        <div class="form-control mb-4">
            <label class="label">Price</label>
            <input type="text" name="price" class="input input-bordered" required />
        </div>
        
        <div class="form-control mb-4">
            <label class="label">Type</label>
            <select name="type" class="select select-bordered" required>
                <option value="apartment">Apartment</option>
                <option value="house">House</option>
                <option value="condo">Condo</option>
            </select>
        </div>

        <div class="form-control mb-4">
            <label class="label cursor-pointer">
                <span class="label-text">Wi-Fi Available</span>
                <input type="checkbox" name="wifi_available" class="toggle toggle-primary" />
            </label>
        </div>

        <div class="form-control mb-4">
            <label class="label">Location</label>
            <input type="text" name="location" class="input input-bordered" required />
        </div>
     
        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</div>
@endsection