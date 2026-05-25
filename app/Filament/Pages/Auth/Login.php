<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class Login extends BaseLogin
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->autofocus()
                    ->autocomplete('email')
                    ->placeholder('seu@email.com'),
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required()
                    ->placeholder('Sua senha segura'),
            ]);
    }
}