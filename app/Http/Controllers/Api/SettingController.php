<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSettingFormRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        return [
            'settings' => $request->user()->settings()->all(),
        ];
    }

    public function save(UserSettingFormRequest $request)
    {
        return [
            'settings' => $request->user()->settings()->setMultiple($request->validated())->all(),
        ];
    }
}
