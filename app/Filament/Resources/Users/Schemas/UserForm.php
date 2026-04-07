<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dane użytkownika')
                    ->description('Podstawowe informacje o użytkowniku')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Imię i nazwisko')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Bezpieczeństwo')
                    ->description('Hasło i uprawnienia')
                    ->icon('heroicon-o-lock-closed')
                    ->columns(1)
                    ->schema([
                        TextInput::make('password')
                            ->label('Hasło')
                            ->password()
                            ->dehydrateStateUsing(fn (?string $state): ?string => blank($state) ? null : bcrypt($state))
                            ->dehydrated(fn (?string $state) => filled($state))
                            ->required(fn (string $operation) => $operation === 'create'),
                    ]),
                Section::make('Role i uprawnienia')
                    ->description('Przypisane role w systemie')
                    ->icon('heroicon-o-shield-check')
                    ->columns(1)
                    ->schema([
                        CheckboxList::make('roles')
                            ->label('Role')
                            ->relationship('roles', 'name')
                            ->columns(1),
                    ]),
            ]);
    }
}
