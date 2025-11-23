<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Create personal access token
        $token = $user->createToken('flutter-app-token')->plainTextToken;

        // Load setting for the user (may be null)
        $setting = Setting::where('createdby', $user->id)->first();

        // Determine custom color (fall back to selected_color or a hard default)
        $selectedColor = $setting->selected_color ?? '#530d82';
        $rawCustomColor = $setting->custom_color ?? null;

        // If custom_color exists and is not the placeholder '#000000', prefer it
        $custom_color = (is_string($rawCustomColor) && trim($rawCustomColor) !== '' && $rawCustomColor !== '#000000')
            ? $rawCustomColor
            : $selectedColor;

        // Determine app mode: default light, switch_state 'on' => dark
        $app_mode = 'dark';
        if (isset($setting->switch_state) && $setting->switch_state === 'on') {
            $app_mode = 'light';
        }

        // Return user + token + theme info
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => $token,
                'custom_color' => $custom_color,
                'app_mode' => $app_mode,
            ],
        ]);
    }
}
