<?php

namespace App\Http\Controllers;



use App\Helpers\Helpers;
use App\Http\Requests\Request;
use App\Models\BusinessSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SharedController extends Controller
{

public function changeLanguage(Request $request): JsonResponse
{
    // Validate the incoming request
    $request->validate([
        'language_code' => 'required|string',
    ]);

    Log::info('Change language request received', ['language_code' => $request->language_code]);

    // Default language direction
    $direction = 'ltr';
    $language = getWebConfig('language');

    foreach ($language as $data) {
        if ($data['code'] == $request['language_code']) {
            $direction = $data['direction'] ?? 'ltr';
        }
    }

    // Log the direction
    Log::info('Language direction determined', ['direction' => $direction]);

    // Clear the session language settings
    session()->forget('language_settings');
    Helpers::language_load();

    // Set the new language code and direction
    session()->put('local', $request['language_code']);
    session()->put('direction', $direction);

    // Log the session values
    Log::info('Session updated', ['local' => session()->get('local'), 'direction' => session()->get('direction')]);

    // Return a successful JSON response
    return response()->json(['message' => translate('language_change_successfully') . '.']);
}
}
