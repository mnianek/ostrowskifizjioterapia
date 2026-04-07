<?php

namespace App\Filament\Resources\Faqs;

use App\Filament\Resources\Faqs\Pages\CreateFaq;
use App\Filament\Resources\Faqs\Pages\EditFaq;
use App\Filament\Resources\Faqs\Pages\ListFaqs;
use App\Models\Faq;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'question';

    public static function getNavigationLabel(): string
    {
        return 'FAQ';
    }

    public static function getModelLabel(): string
    {
        return 'pytanie';
    }

    public static function getPluralModelLabel(): string
    {
        return 'FAQ';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Treść FAQ')
                    ->columns(2)
                    ->schema([
                        TextInput::make('question')
                            ->label('Pytanie')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        RichEditor::make('answer')
                            ->label('Odpowiedź')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktywne')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Kolejność')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->label('Pytanie')
                    ->searchable()
                    ->limit(70),
                ToggleColumn::make('is_active')
                    ->label('Aktywne'),
                TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFaqs::route('/'),
            'create' => CreateFaq::route('/create'),
            'edit' => EditFaq::route('/{record}/edit'),
        ];
    }
}
