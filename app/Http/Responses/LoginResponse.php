<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;
use Bpuig\Subby\Models\Plan;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();
        if ($user->hasRole('Parent')) {
            return redirect()->route('filament.parent.pages.dashboard');
        } else if($user->hasRole('Driver')) {
            return redirect()->route('filament.driver.pages.dashboard');
        }else{
            return redirect()->route('filament.admin.pages.dashborad');
        }

        return parent::toResponse($request);
    }
}
