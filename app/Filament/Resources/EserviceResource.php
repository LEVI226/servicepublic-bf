<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EserviceResource\Pages;
use App\Models\Eservice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EserviceResource extends Resource
{
    protected static ?string $model = Eservice::class;
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Outils & Médias';
    protected static ?string $navigationLabel = 'E-Services';
    protected static ?string $modelLabel = 'E-Service';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('eservices/attachments')
                    ->fileAttachmentsVisibility('public'),

                Forms\Components\TextInput::make('url')
                    ->label('URL du service')
                    ->url()
                    ->required()
                    ->placeholder('https://...'),
                Forms\Components\Select::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('order')
                        ->label('Ordre')
                        ->numeric()
                        ->default(0),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Mis en avant'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable()
                ->weight('bold'),
            Tables\Columns\TextColumn::make('url')
                ->label('URL')
                ->limit(40)
                ->url(fn ($record) => $record->url, shouldOpenInNewTab: true)
                ->color('primary'),
            Tables\Columns\TextColumn::make('category.name')
                ->label('Catégorie')
                ->badge()
                ->color('success'),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Actif')
                ->boolean(),
            Tables\Columns\IconColumn::make('is_featured')
                ->label('⭐')
                ->boolean(),
        ])
        ->defaultSort('order')
        ->filters([
            Tables\Filters\TernaryFilter::make('is_active')->label('Actif'),
            Tables\Filters\SelectFilter::make('category_id')
                ->label('Catégorie')
                ->relationship('category', 'name'),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEservices::route('/'),
            'create' => Pages\CreateEservice::route('/create'),
            'edit' => Pages\EditEservice::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description', 'url'];
    }
}
