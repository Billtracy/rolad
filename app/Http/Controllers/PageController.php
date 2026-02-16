<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredProperties = \App\Models\Property::where('is_featured', true)->orderBy('id', 'desc')->take(3)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $faqs = Faq::active()->take(8)->get();
        return view('home', compact('featuredProperties', 'testimonials', 'faqs'));
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

    public function testimonials()
    {
        $testimonials = Testimonial::active()->paginate(12);
        return view('pages.testimonials', compact('testimonials'));
    }

    public function faqs()
    {
        $faqs = Faq::active()->get();
        return view('pages.faqs', compact('faqs'));
    }
}

