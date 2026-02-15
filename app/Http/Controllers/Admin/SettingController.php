<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Handle unchecked checkboxes (they won't be in the request)
        $checkboxes = ['enable_card_payment', 'enable_bank_transfer'];
        foreach ($checkboxes as $checkbox) {
            if (!$request->has($checkbox)) {
                Setting::updateOrCreate(
                    ['key' => $checkbox],
                    ['value' => '0']
                );
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
