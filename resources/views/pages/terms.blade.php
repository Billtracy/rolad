@extends('layouts.app')

@section('title', 'Terms and Conditions - ROLAD Properties')

@section('content')
    <div class="bg-primary pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Terms and Conditions</h1>
            <p class="text-xl text-gray-200">The rules and regulations for the use of ROLAD Properties' Website.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 prose prose-lg text-gray-600">
        <p>Last updated: {{ date('F d, Y') }}</p>

        <h3>1. Agreement to Terms</h3>
        <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use ROLAD
            Properties if you do not agree to take all of the terms and conditions stated on this page.</p>

        <h3>2. Intellectual Property Rights</h3>
        <p>Other than the content you own, under these Terms, ROLAD Properties and/or its licensors own all the intellectual
            property rights and materials contained in this Website.</p>
        <p>You are granted limited license only for purposes of viewing the material contained on this Website.</p>

        <h3>3. Restrictions</h3>
        <p>You are specifically restricted from all of the following:</p>
        <ul>
            <li>publishing any Website material in any other media;</li>
            <li>selling, sublicensing and/or otherwise commercializing any Website material;</li>
            <li>publicly performing and/or showing any Website material;</li>
            <li>using this Website in any way that is or may be damaging to this Website;</li>
            <li>using this Website in any way that impacts user access to this Website;</li>
        </ul>

        <h3>4. Limitation of liability</h3>
        <p>In no event shall ROLAD Properties, nor any of its officers, directors and employees, be held liable for anything
            arising out of or in any way connected with your use of this Website whether such liability is under contract.
            ROLAD Properties, including its officers, directors and employees shall not be held liable for any indirect,
            consequential or special liability arising out of or in any way related to your use of this Website.</p>

        <h3>5. Variation of Terms</h3>
        <p>ROLAD Properties is permitted to revise these Terms at any time as it sees fit, and by using this Website you are
            expected to review these Terms on a regular basis.</p>
    </div>
@endsection
