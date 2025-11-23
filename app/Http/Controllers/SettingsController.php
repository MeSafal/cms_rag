<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function edit(){
        $setting = Setting::where('createdby', Auth::id())->first();
        if ($setting) {
            $settingArray = $setting->toArray();
        return view('backend.pages.setting', compact('settingArray'));
        } else {
            return redirect()->route('dashboard');
        }
    }


    public function save(Request $request)
    {
        $profile = false;
        // dd($request->all());
        if($request->image == 'true'){
            $data = $request->only([
                'profile_image',
            ]);
            $profile = true;
        }
        else{
            $data = $request->only([
                'switch_state',
                'custom_color',
                'selected_color',
            ]);
        }

        $data['createdby'] = Auth::id();

        // Find the existing setting for the authenticated user
        $setting = Setting::where('createdby', Auth::id())->first();

        if (!$setting) {
            // If no record exists, create a new one
            Setting::create($data);
        } else {
            $setting->update($data);
        }

        // Redirect with a success message
       if($profile){
        return redirect()->route('profile.edit')
        ->with('success', 'Setting saved successfully!');
       }
       else{
       return redirect()->back();
       }
    }

    /**
 * Toggle theme (dark/light) via AJAX.
 * Accepts optional `switch_state` in request ('on' = dark, 'off' = light).
 * If not provided, the value will be toggled from the current setting.
 *
 * Returns JSON with the new switch_state and theme colors the frontend can use.
 */
public function toggleTheme(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    // Find or create setting record for the user
    $setting = Setting::firstOrCreate(
        ['createdby' => $user->id],
        [
            'switch_state'    => 'on',
            'custom_color'    => '#000000',
            'selected_color'  => '#530d82',
            'status'          => 1,
            'display_order'   => 1,
            'createdby'       => $user->id,
            'updatedby'       => $user->id,
        ]
    );

    // Determine desired state: prefer request value, otherwise toggle
    $requested = $request->input('switch_state');
    if (!in_array($requested, ['on', 'off'], true)) {
        $newState = ($setting->switch_state ?? 'on') === 'on' ? 'off' : 'on';
    } else {
        $newState = $requested;
    }

    // Persist
    $setting->switch_state = $newState;
    $setting->updatedby = $user->id;
    $setting->save();

    // Compute theme color values for frontend convenience (same logic as view)
    if ($newState === 'on') {
        $theme_color = '#191C24';
        $dark_color  = '#000000';
        $head_color  = '#FFFFFF';
    } else {
        $theme_color = '#E6E3DB';
        $dark_color  = '#f7efef';
        $head_color  = '#000000';
    }

    // Decide custom color (respecting stored values)
    $custom_color = ($setting->custom_color ?? '#000000') !== '#000000'
        ? ($setting->custom_color ?? '#000000')
        : ($setting->selected_color ?? '#530d82');

    // optional: provide faded/shadow values (simple rgba fallback)
    $faded_color = null;
    try {
        $hex = ltrim($custom_color, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (strlen($hex) === 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            $faded_color = "rgba($r,$g,$b,0.6)";
            $shadow = "3px 6px 6px rgba($r,$g,$b,0.3)";
        }
    } catch (\Throwable $e) {
        $faded_color = 'rgba(0,0,0,0.3)';
        $shadow = '3px 6px 6px rgba(0,0,0,0.3)';
    }

    $mode = $newState === 'on' ? 'Light' : 'Dark';
    return response()->json([
        'status'       => 'success',
        'message'   => 'Theme updated to '. $mode
    ]);
}


}
