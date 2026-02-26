<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcedureResource\Pages;
use App\Models\Procedure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProcedureResource extends Resource
{
    protected static ?string $model = Procedure::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Contenu éditorial';
    protected static ?string $navigationLabel = 'Fiches pratiques';
    protected static ?string $modelLabel = 'Procédure';
    protected static ?string $pluralModelLabel = 'Procédures';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Tabs::make('Fiche Pratique')->tabs([
                    Forms\Components\Tabs\Tab::make('Identification')
                        ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                                $set('slug', Str::slug($state))
                            )
                            ->hint('Nom complet de la démarche tel qu\'il sera affiché au citoyen.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->hint('Identifiant URL généré automatiquement. Ne modifiez que si nécessaire.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icône Bootstrap/FontAwesome')
                            ->placeholder('Ex: bi bi-briefcase or fas fa-star')
                            ->datalist([
                                'bi bi-briefcase', 'bi bi-person-plus', 'bi bi-heart', 
                                'bi bi-passport', 'bi bi-person-badge', 'bi bi-search', 
                                'bi bi-house', 'bi bi-journal-x', 'bi bi-sun', 
                                'bi bi-book', 'bi bi-car-front', 'bi bi-hospital', 
                                'bi bi-bank', 'bi bi-shield-check', 'bi bi-file-earmark-text', 
                                'bi bi-globe', 'bi bi-telephone', 'bi bi-folder', 
                                'bi bi-cash', 'bi bi-shop', 'bi bi-mortarboard'
                            ])
                            ->hint('Classe CSS de l\'icône. Commencez à taper pour voir les suggestions.')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->hint('Thématique principale (ex: Commerce/Artisanat, Justice…).'),
                        Forms\Components\Select::make('subcategory_id')
                            ->label('Sous-catégorie')
                            ->relationship('subcategory', 'name')
                            ->searchable()
                            ->preload()
                            ->hint('Subdivision optionnelle de la catégorie.'),
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('procedures/attachments')
                            ->fileAttachmentsVisibility('public')
                            ->hint('Description détaillée de la démarche : objectif, public concerné, contexte.')
                            ->columnSpanFull(),
                    ]),

                    Forms\Components\Tabs\Tab::make('Documents requis')
                        ->schema([
                        Forms\Components\RichEditor::make('documents_required')
                            ->label('Pièces à fournir')
                            ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('procedures/attachments')
                            ->fileAttachmentsVisibility('public')
,
                    ]),

                    Forms\Components\Tabs\Tab::make('Conditions & Délai')
                        ->schema([
                        Forms\Components\RichEditor::make('conditions')
                            ->label('Conditions')
                            ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('procedures/attachments')
                            ->fileAttachmentsVisibility('public')
,
                        Forms\Components\RichEditor::make('more_info')
                            ->label('Informations complémentaires')
                            ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('procedures/attachments')
                            ->fileAttachmentsVisibility('public')
,
                        ]),
                ]),

            ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make()->schema([

                Forms\Components\Section::make('Publication')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active (visible)')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Mise en avant'),
                    ]),

                Forms\Components\Section::make('Informations clés')
                    ->schema([
                        Forms\Components\TextInput::make('cost')
                            ->label('Coût')
                            ->placeholder('Ex: 1 000 FCFA')
                            ->maxLength(100)
                            ->hint('Montant en FCFA. Indiquez « Gratuit » si applicable.'),
                        Forms\Components\TextInput::make('delay')
                            ->label('Délai')
                            ->placeholder('Ex: 1 à 3 mois')
                            ->maxLength(100)
                            ->hint('Durée estimée de traitement du dossier.'),
                        Forms\Components\Toggle::make('is_free')
                            ->label('Gratuit'),
                    ]),

                Forms\Components\Section::make('SEO')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta titre')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta description')
                            ->rows(2),
                    ]),

                Forms\Components\Section::make('Statistiques')
                    ->schema([
                        Forms\Components\Placeholder::make('views_display')
                            ->label('Nombre de vues')
                            ->content(fn (?Procedure $record): string => $record ? number_format($record->views_count, 0, ',', ' ') : '0'),
                        Forms\Components\Placeholder::make('created_at_display')
                            ->label('Créée le')
                            ->content(fn (?Procedure $record): string => $record?->created_at?->format('d/m/Y H:i') ?? '—'),
                    ])
                    ->visibleOn('edit'),

            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icône')
                    ->html()
                    ->formatStateUsing(fn ($state) => $state ? sprintf('<i class="%s text-xl"></i>', $state) : '')
                    ->width('80px')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('⭐')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Vues')
                    ->sortable()
                    ->numeric()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('cost')
                    ->label('Coût')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Mise en avant'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\ProcedureResource\RelationManagers\DocumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProcedures::route('/'),
            'create' => Pages\CreateProcedure::route('/create'),
            'edit' => Pages\EditProcedure::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }
}
