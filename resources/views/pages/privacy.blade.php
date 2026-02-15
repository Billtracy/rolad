@extends('layouts.app')

@section('title', 'Privacy Policy - ROLAD Properties')

@section('content')
    <div class="bg-primary pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Privacy Policy</h1>
            <p class="text-xl text-gray-200">How we handle your data and protect your privacy.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 prose prose-lg text-gray-600">
        <p>Last updated: {{ date('F d, Y') }}</p>

        <h3>1. Introduction</h3>
        <p>At ROLAD Properties, we respect your privacy and are committed to protecting your personal data. This privacy
            policy will inform you as to how we look after your personal data when you visit our website and tell you about
            your privacy rights and how the law protects you.</p>

        <h3>2. Data We Collect</h3>
        <p>We may collect, use, store and transfer different kinds of personal data about you which we have grouped together
            follows:</p>
        <ul>
            <li><strong>Identity Data</strong> includes first name, maiden name, last name, username or similar identifier.
            </li>
            <li><strong>Contact Data</strong> includes billing address, delivery address, email address and telephone
                numbers.</li>
            <li><strong>Technical Data</strong> includes internet protocol (IP) address, your login data, browser type and
                version, time zone setting and location, browser plug-in types and versions, operating system and platform
                and other technology on the devices you use to access this website.</li>
        </ul>

        <h3>3. How We Use Your Data</h3>
        <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in
            the following circumstances:</p>
        <ul>
            <li>Where we need to perform the contract we are about to enter into or have entered into with you.</li>
            <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and
                fundamental rights do not override those interests.</li>
            <li>Where we need to comply with a legal or regulatory obligation.</li>
        </ul>

        <h3>4. Data Security</h3>
        <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost,
            used or accessed in an unauthorized way, altered or disclosed.</p>

        <h3>5. Contact Us</h3>
        <p>If you have any questions about this privacy policy or our privacy practices, please contact us at: <a
                href="mailto:info@roladproperties.com">info@roladproperties.com</a>.</p>
    </div>
@endsection
