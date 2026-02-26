<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganismeResource\Pages;
use App\Models\Organisme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrganismeResource extends Resource
{
    protected static ?string $model = Organisme::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?string $navigationLabel = 'Annuaire (Organismes)';
    protected static ?string $modelLabel = 'Organisme';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identification')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state)))
                        ->hint('Nom officiel complet de l\'organisme.'),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->hint('Identifiant URL généré automatiquement.'),
                ]),
                Forms\Components\TextInput::make('acronym')
                    ->label('Sigle')
                    ->maxLength(20)
                    ->placeholder('Ex: MTDPCE')
                    ->hint('Abréviation courante (ex: CNSS, CEFORE, DGI).'),
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons(['bold', 'italic', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'attachFiles'])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('organismes/attachments')
                    ->fileAttachmentsVisibility('public')

                    ->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Coordonnées')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('address')
                        ->label('Adresse')
                        ->maxLength(255)
                        ->hint('Adresse postale complète.'),
                    Forms\Components\TextInput::make('city')
                        ->label('Ville')
                        ->maxLength(100)
                        ->hint('Ville où se situe le siège principal.'),
                ]),
                Forms\Components\TextInput::make('region')
                    ->label('Région')
                    ->maxLength(100)
                    ->hint('Région administrative du Burkina Faso.'),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('phone')
                        ->label('Téléphone')
                        ->tel()
                        ->maxLength(50)
                        ->hint('Format : (+226) XX XX XX XX.'),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('website')
                        ->label('Site web')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('https://...'),
                ]),
                Forms\Components\TextInput::make('hours')
                    ->label('Horaires')
                    ->maxLength(255)
                    ->placeholder('Lun-Ven 7h30-12h30, 15h-17h30')
                    ->hint('Horaires d\'ouverture au public.'),
            ]),
            Forms\Components\Section::make('Géolocalisation')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('latitude')->numeric()->placeholder('12.3714')
                        ->hint('Coordonnée GPS Nord/Sud.'),
                    Forms\Components\TextInput::make('longitude')->numeric()->placeholder('-1.5197')
                        ->hint('Coordonnée GPS Est/Ouest.'),
                ]),
            ])->collapsed(),
            Forms\Components\Toggle::make('is_active')
                ->label('Organisme actif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(50),
            Tables\Columns\TextColumn::make('acronym')
                ->label('Sigle')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('gray'),
            Tables\Columns\TextColumn::make('city')
                ->label('Ville')
                ->sortable()
                ->toggleable(),
            Tables\Columns\TextColumn::make('phone')
                ->label('Téléphone')
                ->toggleable(),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Actif')
                ->boolean(),
        ])
        ->defaultSort('name')
        ->filters([
            Tables\Filters\TernaryFilter::make('is_active')->label('Actif'),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganismes::route('/'),
            'create' => Pages\CreateOrganisme::route('/create'),
            'edit' => Pages\EditOrganisme::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'acronym', 'description'];
    }
}
