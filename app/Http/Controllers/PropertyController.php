<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', '!=', 'sold_out')->latest()->get();
        return view('properties.index', compact('properties'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();
        return view('properties.show', compact('property'));
    }
}
