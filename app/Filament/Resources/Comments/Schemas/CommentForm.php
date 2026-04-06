<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_id')
                    ->label('Post')
                    ->relationship('post', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('user_name')
                    ->label('Autor')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->label('Treść')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
                Toggle::make('is_approved')
                    ->label('Zatwierdzony')
                    ->default(false)
                    ->required(),
            ]);
    }
}
