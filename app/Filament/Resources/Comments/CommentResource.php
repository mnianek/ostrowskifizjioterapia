<?php

namespace App\Filament\Resources\Comments;

use App\Filament\Resources\Comments\Pages\CreateComment;
use App\Filament\Resources\Comments\Pages\EditComment;
use App\Filament\Resources\Comments\Pages\ListComments;
use App\Filament\Resources\Comments\Schemas\CommentForm;
use App\Filament\Resources\Comments\Tables\CommentsTable;
use App\Models\Comment;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'user_name';

    public static function getModelLabel(): string
    {
        return 'komentarz';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Dyskusje';
    }

    public static function form(Schema $schema): Schema
    {
        return CommentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user_name', 'content', 'post.title'];
    }

    public static function getGlobalSearchResultsLimit(): int
    {
        return 10;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Treść' => Str::limit($record->content, 80),
        ];
    }

    /**
     * @return array<Action>
     */
    public static function getGlobalSearchResultActions(Model $record): array
    {
        if ($record->is_approved) {
            return [];
        }

        return [
            Action::make('approve')
                ->label('Zatwierdź')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function (Comment $record): void {
                    $record->update(['is_approved' => true]);
                })
                ->visible(fn (Comment $record): bool => ! $record->is_approved),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCommentsCount = static::getModel()::query()
            ->where('is_approved', false)
            ->count();

        if ($pendingCommentsCount === 0) {
            return null;
        }

        return (string) $pendingCommentsCount;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
