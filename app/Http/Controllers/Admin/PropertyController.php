<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = \App\Models\Property::latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'inspection_fee' => 'nullable|numeric|min:0',
            'type' => 'required|string|in:land,house,apartment',
            'status' => 'required|string|in:available,sold_out,reserved',
            'features' => 'nullable|string', // comma separated
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $slug = \Illuminate\Support\Str::slug($validated['title']);
        $count = \App\Models\Property::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= "-{$count}";
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }

        // Handle features as comma-separated string -> array
        $features = $request->features ? array_map('trim', explode(',', $request->features)) : [];

        \App\Models\Property::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'location' => $validated['location'],
            'price' => $validated['price'],
            'inspection_fee' => $validated['inspection_fee'] ?? 0,
            'type' => $validated['type'],
            'status' => $validated['status'],
            'features' => $features,
            'images' => $imagePaths,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'inspection_fee' => 'nullable|numeric|min:0',
            'type' => 'required|string|in:land,house,apartment',
            'status' => 'required|string|in:available,sold_out,reserved',
            'features' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        if ($request->title !== $property->title) {
            $slug = \Illuminate\Support\Str::slug($validated['title']);
            $count = \App\Models\Property::where('slug', 'like', "{$slug}%")->where('id', '!=', $property->id)->count();
            if ($count > 0) {
                $slug .= "-{$count}";
            }
            $property->slug = $slug;
        }

        $imagePaths = $property->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $imagePaths[] = '/storage/' . $path; // Fixed: Append to existing array, or should we merge?
                // The above line appends. If the user wants to REPLACE all images, they might need a delete function.
                // For now, appending is safer.
            }
        }

        $features = $request->features ? array_map('trim', explode(',', $request->features)) : [];

        $property->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'price' => $validated['price'],
            'inspection_fee' => $validated['inspection_fee'] ?? 0,
            'type' => $validated['type'],
            'status' => $validated['status'],
            'features' => $features,
            'images' => $imagePaths,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
