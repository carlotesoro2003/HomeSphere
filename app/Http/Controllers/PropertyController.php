<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;


class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $properties = $query->get();

        return view('properties.index', compact('properties'));
    }



    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image file
        ]);

        // Process the image if uploaded
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        // Create the property with all inputs
        Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'location' => $request->location,
            'wifi_available' => $request->has('wifi_available'),
            'image_path' => $imagePath,
        ]);

        // Redirect to the properties index with success message
        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }


    public function update(Request $request, Property $property)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image file
        ]);

        // Process the image if uploaded
        $imagePath = $property->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        // Update the property with all inputs
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'location' => $request->location,
            'wifi_available' => $request->has('wifi_available'),
            'image_path' => $imagePath,
        ]);

        // Redirect to the properties index with success message
        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }
}
