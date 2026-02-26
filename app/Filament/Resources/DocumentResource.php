<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?string $navigationGroup = 'Outils & Médias';
    protected static ?string $navigationLabel = 'Documents & Formulaires';
    protected static ?string $modelLabel = 'Document';
    protected static ?string $pluralModelLabel = 'Documents';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations du document')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required()
                        ->maxLength(500)
                        ->hint('Nom descriptif du document (ex: « Formulaire de demande de passeport »).'),
                    Forms\Components\Select::make('procedure_id')
                        ->label('Procédure liée')
                        ->relationship('procedure', 'title')
                        ->searchable()
                        ->preload()
                        ->hint('Rattacher le document à une procédure le rend téléchargeable depuis la fiche pratique correspondante.'),
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Fichier')
                        ->required()
                        ->disk('public')
                        ->directory('documents')
                        ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                        ->maxSize(10240)
                        ->hint('Formats acceptés : PDF, DOC, DOCX. Taille max : 10 Mo.'),
                ]),
            Forms\Components\Section::make('Métadonnées')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('file_type')
                            ->label('Type')
                            ->placeholder('pdf')
                            ->hint('Extension du fichier (ex: pdf, doc, docx).'),
                        Forms\Components\TextInput::make('file_size')
                            ->label('Taille (octets)')
                            ->numeric()
                            ->hint('Taille en octets. Remplie automatiquement si laissée vide.'),
                    ]),
                    Forms\Components\Placeholder::make('downloads_display')
                        ->label('Téléchargements')
                        ->content(fn (?Document $record): string => $record ? number_format($record->downloads_count, 0, ',', ' ') : '0'),
                ])
                ->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(60),
                Tables\Columns\TextColumn::make('procedure.title')
                    ->label('Procédure')
                    ->sortable()
                    ->limit(40)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'pdf' => 'danger',
                        'doc', 'docx' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('downloads_count')
                    ->label('Téléchargements')
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('title')
            ->filters([
                Tables\Filters\SelectFilter::make('file_type')
                    ->label('Type de fichier')
                    ->options([
                        'pdf' => 'PDF',
                        'doc' => 'DOC',
                        'docx' => 'DOCX',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }
}
