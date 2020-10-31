<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserAppsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('SamplePage');
    }

    public function indexSetting(Request $request)
    {
        return Inertia::render('SampleSettingPage', [
            'settings' => $request->user()->settings()->all(),
        ]);
    }

    public function updateSetting(UserSettingFormRequest $request)
    {
        $settings = $request->user()->settings()->setMultiple($request->validated())->all();

        return Inertia::render('SampleSettingPage', [
            'settings' => $settings,
            'flash' => [
                'success' => 'Settings updated successfully.',
            ],
        ]);
    }
}
