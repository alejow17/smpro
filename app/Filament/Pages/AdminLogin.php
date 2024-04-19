<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Facades\Filament;

class AdminLogin extends Login
{
    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        if (app()->environment('local')) {
            $this->form->fill([
                'username' => 'admin',
                'password' => 'password',
            ]);
        }
    }

    public function getTitle(): string|Htmlable
    {
        return __('Inicio de sesión');
    }

    public function getHeading(): string|Htmlable
    {
        return __('');
    }
}
