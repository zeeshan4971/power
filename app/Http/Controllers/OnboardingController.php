<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function progress(Request $request): JsonResponse
    {
        $data = $request->validate([
            'step' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $request->user()->update([
            'onboarding_step' => $data['step'],
            'onboarding_completed_at' => null,
        ]);

        return response()->json(['saved' => true]);
    }

    public function complete(Request $request): JsonResponse
    {
        $request->user()->update([
            'onboarding_completed_at' => now(),
            'onboarding_step' => 0,
        ]);

        return response()->json(['completed' => true]);
    }

    public function restart(Request $request): RedirectResponse
    {
        $request->user()->update([
            'onboarding_completed_at' => null,
            'onboarding_step' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', 'Guided tour restarted.');
    }
}
