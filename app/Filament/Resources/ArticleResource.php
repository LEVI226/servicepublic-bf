<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Contenu éditorial';
    protected static ?string $navigationLabel = 'Actualités';
    protected static ?string $modelLabel = 'Article';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make('Contenu')->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Chapeau / Résumé')
                        ->rows(2),
                    Forms\Components\FileUpload::make('image')
                        ->label('Image d\'illustration')
                        ->image()
                        ->directory('articles/images')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content')
                        ->label('Contenu')
                        ->required()
                        ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('articles/attachments')
                        ->fileAttachmentsVisibility('public')

                        ->columnSpanFull(),
                ]),
            ])->columnSpan(['lg' => 2]),
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make('Publication')->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publié')
                        ->default(false),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Date de publication')
                        ->displayFormat('d/m/Y H:i')
                        ->default(now()),
                    Forms\Components\Select::make('category_id')
                        ->label('Catégorie')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload(),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Mise en avant'),
                ]),
                Forms\Components\Section::make('Statistiques')
                    ->schema([
                        Forms\Components\Placeholder::make('views_display')
                            ->label('Nombre de vues')
                            ->content(fn (?Article $record): string => $record ? number_format($record->views_count, 0, ',', ' ') : '0'),
                    ])
                    ->visibleOn('edit'),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Image')
                ->circular(),
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable()
                ->limit(50)
                ->weight('bold'),
            Tables\Columns\IconColumn::make('is_published')
                ->label('Publié')
                ->boolean(),
            Tables\Columns\TextColumn::make('published_at')
                ->label('Date')
                ->date('d/m/Y')
                ->sortable(),
            Tables\Columns\IconColumn::make('is_featured')
                ->label('⭐')
                ->boolean(),
            Tables\Columns\TextColumn::make('views_count')
                ->label('Vues')
                ->sortable()
                ->numeric(),
        ])
        ->defaultSort('published_at', 'desc')
        ->filters([
            Tables\Filters\TrashedFilter::make(),
            Tables\Filters\TernaryFilter::make('is_published')->label('Publié'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(), 
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\RestoreAction::make(),
            Tables\Actions\ForceDeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ])
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
