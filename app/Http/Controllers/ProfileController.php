<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        $request->validate([
            'address' => 'required|string',
            'dob' => 'required|date',
            'state_of_origin' => 'required|string',
            'lga' => 'required|string',
            'occupation' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'passport' => 'nullable|image|max:2048', // 2MB max
            'valid_id' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'nok_name' => 'required|string',
            'nok_phone' => 'required|string',
            'nok_email' => 'required|email',
            'nok_address' => 'required|string',
            'referral_source' => 'nullable|string',
        ]);

        $data = $request->except(['passport', 'valid_id', '_token', '_method']);

        if ($request->hasFile('passport')) {
            $path = $request->file('passport')->store('passports', 'public');
            $data['passport_path'] = $path;
        }

        if ($request->hasFile('valid_id')) {
            $path = $request->file('valid_id')->store('ids', 'public');
            $data['valid_id_path'] = $path;
        }

        // If profile didn't exist, create it via relationship to ensure ID is set.
        if (!$user->profile) {
             $user->profile()->create($data);
        } else {
             $user->profile->update($data);
        }

        // Mark user as active/KYC complete if all required fields are present
        // For now, assume submission means complete as validation enforced it.
        $user->update(['is_active' => true]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }
}
