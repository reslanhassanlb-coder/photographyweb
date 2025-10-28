<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Users;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Bus\PendingBatch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;
class PostResource extends Resource
{
    protected static ?string $model = Post::class;


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')->label('Category')->required()->options(Categories::all()->pluck('name', 'id'))->searchable()->columns(1),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\FileUpload::make('image')->disk('posts')->required(),
                Forms\Components\Textarea::make('image_alt'),
                Forms\Components\Hidden::make('author_id')->default(fn () => auth()->id()),
                Forms\Components\RichEditor::make('description')->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])->fileAttachmentsDisk('public')->fileAttachmentsDirectory('attachments')->columns(1)->required(),
                Forms\Components\Toggle::make('top_post')->onColor('success')->offColor('danger'),
                Forms\Components\Toggle::make('display_in_home')->onColor('success')->offColor('danger'),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {

        return $table

            ->columns([
                TextColumn::make('title')->searchable(),
                ImageColumn::make('image')->disk('posts')->square(),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                TextColumn::make('description')->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                       /* if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }*/

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),
                TextColumn::make('created_at')->label('Date')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->options(Categories::all()->pluck('name', 'id'))->label('By Category'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
