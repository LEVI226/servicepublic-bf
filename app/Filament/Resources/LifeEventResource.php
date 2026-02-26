<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LifeEventResource\Pages;
use App\Models\LifeEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LifeEventResource extends Resource
{
    protected static ?string $model = LifeEvent::class;
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationGroup = 'Événements de vie';
    protected static ?string $navigationLabel = 'Comment faire si ?';
    protected static ?string $modelLabel = 'Événement de vie';
    protected static ?string $pluralModelLabel = 'Événements de vie';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state)))
                        ->hint('Titre de la situation de vie tel qu\'affiché dans la section « Comment faire si ? » (ex: « Je demande un passeport »).'),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->hint('Identifiant URL unique, généré automatiquement à partir du titre.'),
                ]),
                Forms\Components\RichEditor::make('description')
                    ->label('Description courte')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('lifeevents/attachments')
                    ->fileAttachmentsVisibility('public')
                    ->hint('Texte court (1-3 phrases) affiché sur la carte dans la liste « Comment faire si ? ».'),
                Forms\Components\RichEditor::make('content')
                    ->label('Contenu détaillé')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('lifeevents/attachments')
                    ->fileAttachmentsVisibility('public')
                    ->hint('Contenu complet affiché sur la page de l\'événement de vie. Peut inclure des conseils, des délais types, etc.')
                    ->columnSpanFull(),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icône Bootstrap')
                        ->placeholder('Ex: bi bi-passport')
                        ->datalist([
                            'bi bi-briefcase', 'bi bi-person-plus', 'bi bi-heart', 
                            'bi bi-passport', 'bi bi-person-badge', 'bi bi-search', 
                            'bi bi-house', 'bi bi-journal-x', 'bi bi-sun', 
                            'bi bi-book', 'bi bi-car-front', 'bi bi-hospital', 
                            'bi bi-bank', 'bi bi-shield-check', 'bi bi-file-earmark-text', 
                            'bi bi-globe', 'bi bi-telephone', 'bi bi-folder', 
                            'bi bi-cash', 'bi bi-shop', 'bi bi-mortarboard'
                        ])
                        ->hint('Classe CSS de l\'icône Bootstrap Icons affichée sur la carte (tapez « bi bi- » pour voir les suggestions).'),
                    Forms\Components\TextInput::make('order')
                        ->label('Ordre d\'affichage')
                        ->numeric()
                        ->default(0)
                        ->hint('Les événements sont triés par ordre croissant (0 = affiché en premier).'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true)
                        ->hint('Désactiver masque cet événement de vie de la page « Comment faire si ? ».'),
                ]),
            ]),
            Forms\Components\Section::make('Procédures associées')
                ->description('Liez les fiches pratiques à réaliser dans le cadre de cet événement de vie.')
                ->schema([
                    Forms\Components\Select::make('procedures')
                        ->label('Fiches pratiques liées')
                        ->relationship('procedures', 'title')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->hint('Sélectionnez toutes les fiches pratiques que doit accomplir un citoyen dans cette situation (ex: pour « Je me marie » → CNIB, Acte de naissance, Acte de mariage).'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
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
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable()
                ->weight('bold'),
            Tables\Columns\TextColumn::make('procedures_count')
                ->counts('procedures')
                ->label('Procédures'),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Actif')
                ->boolean(),
        ])
        ->defaultSort('order')
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLifeEvents::route('/'),
            'create' => Pages\CreateLifeEvent::route('/create'),
            'edit' => Pages\EditLifeEvent::route('/{record}/edit'),
        ];
    }
}
