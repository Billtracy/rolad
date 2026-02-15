@extends('layouts.app')

@section('title', 'Disclaimer - ROLAD Properties')

@section('content')
    <div class="bg-primary pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Disclaimer</h1>
            <p class="text-xl text-gray-200">Legal disclaimer for using our services.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 prose prose-lg text-gray-600">
        <p>Last updated: {{ date('F d, Y') }}</p>

        <h3>1. Website Disclaimer</h3>
        <p>The information provided by ROLAD Properties ("we," "us," or "our") on this website is for general informational
            purposes only. All information on the Site is provided in good faith, however we make no representation or
            warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability,
            or completeness of any information on the Site.</p>

        <h3>2. External Links Disclaimer</h3>
        <p>The Site may contain (or you may be sent through the Site) links to other websites or content belonging to or
            originating from third parties or links to websites and features in banners or other advertising. Such external
            links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability,
            or completeness by us.</p>

        <h3>3. Professional Disclaimer</h3>
        <p>The Site cannot and does not contain legal or real estate advice. The real estate information is provided for
            general informational and educational purposes only and is not a substitute for professional advice.
            Accordingly, before taking any actions based upon such information, we encourage you to consult with the
            appropriate professionals. We do not provide any kind of legal or real estate advice. The use or reliance of any
            information contained on the Site is solely at your own risk.</p>
    </div>
@endsection
