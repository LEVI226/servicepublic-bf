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
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                ]),
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('lifeevents/attachments')
                    ->fileAttachmentsVisibility('public')
,
                Forms\Components\RichEditor::make('content')
                    ->label('Contenu détaillé')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('lifeevents/attachments')
                    ->fileAttachmentsVisibility('public')

                    ->columnSpanFull(),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icône Bootstrap/FontAwesome')
                        ->placeholder('Ex: bi bi-passport or fas fa-home')
                        ->datalist([
                            'bi bi-briefcase', 'bi bi-person-plus', 'bi bi-heart', 
                            'bi bi-passport', 'bi bi-person-badge', 'bi bi-search', 
                            'bi bi-house', 'bi bi-journal-x', 'bi bi-sun', 
                            'bi bi-book', 'bi bi-car-front', 'bi bi-hospital', 
                            'bi bi-bank', 'bi bi-shield-check', 'bi bi-file-earmark-text', 
                            'bi bi-globe', 'bi bi-telephone', 'bi bi-folder', 
                            'bi bi-cash', 'bi bi-shop', 'bi bi-mortarboard'
                        ]),
                    Forms\Components\TextInput::make('order')
                        ->label('Ordre')
                        ->numeric()
                        ->default(0),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true),
                ]),
            ]),
            Forms\Components\Section::make('Procédures associées')
                ->description('Sélectionnez les procédures liées à cet événement de vie.')
                ->schema([
                    Forms\Components\Select::make('procedures')
                        ->label('Procédures')
                        ->relationship('procedures', 'title')
                        ->multiple()
                        ->searchable()
                        ->preload(),
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
