<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Contenu éditorial';
    protected static ?string $navigationLabel = 'Catégories';
    protected static ?string $modelLabel = 'Catégorie';
    protected static ?string $pluralModelLabel = 'Catégories';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations de la catégorie')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                                $set('slug', Str::slug($state))
                            )
                            ->hint('Nom de la thématique affiché sur le site (ex: « Commerce/Artisanat »).'),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->hint('URL générée automatiquement. Ex: commerce-artisanat.'),
                    ]),
                    Forms\Components\RichEditor::make('description')
                        ->label('Description')
                        ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('categories/attachments')
                        ->fileAttachmentsVisibility('public')
                        ->hint('Texte d\'introduction affiché en haut de la page thématique.')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('order')
                        ->label('Ordre')
                        ->numeric()
                        ->default(0)
                        ->minValue(0),
                ]),
            Forms\Components\Section::make('Apparence')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Icône Bootstrap/FontAwesome')
                            ->placeholder('Ex: bi bi-house or fas fa-star')
                            ->datalist([
                                'bi bi-briefcase', 'bi bi-person-plus', 'bi bi-heart', 
                                'bi bi-passport', 'bi bi-person-badge', 'bi bi-search', 
                                'bi bi-house', 'bi bi-journal-x', 'bi bi-sun', 
                                'bi bi-book', 'bi bi-car-front', 'bi bi-hospital', 
                                'bi bi-bank', 'bi bi-shield-check', 'bi bi-file-earmark-text', 
                                'bi bi-globe', 'bi bi-telephone', 'bi bi-folder', 
                                'bi bi-cash', 'bi bi-shop', 'bi bi-mortarboard'
                            ])
                            ->hint('Icône affichée sur la carte thématique. Tapez pour voir les suggestions.'),
                        Forms\Components\ColorPicker::make('color')
                            ->label('Couleur d\'accentuation')
                            ->hint('Couleur de la barre d\'accent sur la carte thématique.'),
                    ]),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Catégorie active')
                        ->default(true),
                ]),
            Forms\Components\Section::make('SEO')
                ->collapsed()
                ->schema([
                    Forms\Components\TextInput::make('meta_title')->label('Meta titre'),
                    Forms\Components\Textarea::make('meta_description')->label('Meta description')->rows(2),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width('60px'),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icône')
                    ->html()
                    ->formatStateUsing(fn ($state) => $state ? sprintf('<i class="%s text-xl"></i>', $state) : '')
                    ->width('80px')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('procedures_count')
                    ->counts('procedures')
                    ->label('Procédures')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
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
            ->reorderable('order');
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\CategoryResource\RelationManagers\SubcategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }
}
