<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Basic Information')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, string $state, Forms\Set $set) => 
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->disabledOn('edit')
                        ->helperText('Auto-generated from title'),

                    Forms\Components\Textarea::make('excerpt')
                        ->maxLength(500)
                        ->rows(3)
                        ->helperText('Short summary for teasers'),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->required()
                        ->default(now())
                        ->helperText('Post visible only after this date'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Content')
                ->schema([
                    Forms\Components\RichEditor::make('content')
                        ->required()
                        ->columnSpan('full')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('posts/content')
                        ->fileAttachmentsVisibility('public')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'color', 'highlight', 'bulletList', 'orderedList',
                            'link', 'image', 'blockquote', 'codeBlock',
                            'h1', 'h2', 'h3',
                            'alignLeft', 'alignCenter', 'alignRight',
                            'undo', 'redo',
                        ]),
                ]),

            Forms\Components\Section::make('Media')
                ->schema([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                ->collection('featured_image')
                ->label('Featured Image')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('posts/featured') // Custom folder
                ->visibility('public')
                ->maxSize(2048)
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('16:9')
                ->helperText('Recommended: 1200×675px'),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('post_images')
                        ->collection('post_images')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('posts/images')
                        ->visibility('public')
                        ->maxFiles(10)
                        ->maxSize(2048)
                        ->helperText('Additional images (will appear in gallery below content)'),
                ]),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('user.name')
                ->label('Author')
                ->sortable()
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('user', function (Builder $query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                }),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Published'),

                Tables\Columns\IconColumn::make('published_at')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->getStateUsing(fn ($record) => $record->published_at && $record->published_at <= now()),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers later (e.g., tags, categories, media)
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