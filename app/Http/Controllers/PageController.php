<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredProperties = \App\Models\Property::where('is_featured', true)->orderBy('id', 'desc')->take(3)->get();
        return view('home', compact('featuredProperties'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
}
