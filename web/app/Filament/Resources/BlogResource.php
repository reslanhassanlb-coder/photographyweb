<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\BlogCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Set; // Use this instead of Closure for setting state
use Filament\Forms\Get;
use Illuminate\Support\Str;
use Filament\Forms\Components\Textarea;
use Closure;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Blog Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('blog_category_id')->label('Category')->required()->options(BlogCategory::all()->pluck('name', 'id'))->searchable()->columns(1),
                Forms\Components\TextInput::make('title')
                 ->required()
                 ->maxLength(255)
                 ->live(onBlur: true)
                  ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),


                Forms\Components\TextInput::make('slug')->required()
                  ->unique(ignoreRecord: true) // Ensure slug is unique
                  ->maxLength(255),

                Select::make('tags')
                ->relationship('tags', 'name') // The first argument is the relationship method (tags()),
                                              // the second is the column to display ('name')
                ->multiple()                  // Must be multiple for many-to-many
                ->preload()                   // Recommended for performance
                ->searchable()                // Recommended for better UX
                ->label('Article Tags'),
                Forms\Components\FileUpload::make('image')->disk('posts')->required(),
                Forms\Components\Textarea::make('image_alt'),
                Forms\Components\Hidden::make('author_id')->default(fn () => auth()->id()),

                RichEditor::make('description')
                ->required()
                ->label('Blog Content')
                ->columnSpanFull()
                ->live(debounce: 1000)
                ->afterStateUpdated(function (Set $set, Get $get, $state) { // <-- CHANGE HERE: Use Set $set
                    // Use $set(...) instead of $set('meta_description', ...)
                    if (empty($get('meta_description'))) {
                        self::generateMetaDescriptionFromContent($set, $state);
                    }
                }),

                // --- META DESCRIPTION FIELD ---
                Textarea::make('meta_description')
                ->label('SEO Meta Description')
                ->helperText('Auto-generated from content (max 160 chars). Edit for a stronger CTA.')
                ->rows(3)
                ->maxLength(160),
                Forms\Components\Toggle::make('top_post')->onColor('success')->offColor('danger'),
                Forms\Components\Toggle::make('display_in_home')->onColor('success')->offColor('danger'),
                Forms\Components\Toggle::make('is_featured')->onColor('success')->offColor('danger'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                ImageColumn::make('image')->disk('posts')->square(),
                TextColumn::make('blogcategory.name')->label('Category')->sortable()->searchable(),
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
                    ->options(BlogCategory::all()->pluck('name', 'id'))->label('By Category'),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }


    /**
     * Generates a plain-text meta description from the rich editor content.
     */
    protected static function generateMetaDescriptionFromContent(Set $set, ?string $content): void // <-- CHANGE HERE: Use Set $set
    {
       // Check for empty content first
        if (empty($content)) {
            $set('meta_description', '');
            return;
        }

        // 1. CLEANING: Strip all HTML tags and normalize whitespace
        $plainText = strip_tags($content);
        $normalizedText = preg_replace('/\s+/', ' ', $plainText);

        // Ensure the text starts clean and ends clean
        $cleanContent = trim($normalizedText);

        // 2. TRIMMING & CTA LOGIC
        $maxLength = 160;
        $cta = " Read the guide now.";
        $ctaLength = strlen($cta);

        $spaceForCta = $maxLength - $ctaLength ;


        // Trim the content to leave space for the CTA
        // If the content is short, it won't be truncated.
        $trimmedContent = Str::limit($cleanContent, $spaceForCta, null);

        // 3. FINAL COMPOSITION
        $finalDescription = $trimmedContent;

        // Only append the CTA if the original content was long enough to be trimmed
        // OR if we want to ensure the CTA is always added if the original content was substantial.
        // The safest check is to see if the trimmed result is different from the original clean text.
        if (strlen($cleanContent) > $spaceForCta) {
            $finalDescription = trim($trimmedContent) . $cta;
        }

        // 4. Set the state of the target field
        $set('meta_description', trim($finalDescription));
    }
}
