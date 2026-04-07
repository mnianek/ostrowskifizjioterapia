<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'Treści';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModelLabel(): string
    {
        return 'wpis';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Blog';
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'category.name'];
    }

    public static function getGlobalSearchResultsLimit(): int
    {
        return 10;
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        $mediaUrl = $record->getFirstMediaUrl('featured_image', 'thumb') ?: $record->getFirstMediaUrl('featured_image');

        if (blank($mediaUrl)) {
            return $record->title;
        }

        return new HtmlString(
            '<span class="flex items-center gap-3"><img src="'.e($mediaUrl).'" alt="'.e($record->title).'" class="h-10 w-10 rounded-lg object-cover ring-1 ring-sky-100">'
            .'<span>'.e($record->title).'</span></span>'
        );
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return array_filter([
            'Kategoria' => $record->category?->name,
            'Data publikacji' => $record->published_at?->translatedFormat('d F Y'),
        ]);
    }

    /**
     * @return array<Action>
     */
    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('view_on_site')
                ->label('Zobacz na stronie')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(route('posts.show', $record->slug)),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
