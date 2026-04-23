<?php

namespace App\Filament\Resources\ProcedureResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';
    protected static ?string $title = 'Documents & Formulaires';
    protected static ?string $modelLabel = 'Document';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->maxLength(500)
                ->hint('Nom descriptif du formulaire ou document.'),
            Forms\Components\FileUpload::make('file_path')
                ->label('Fichier')
                ->required()
                ->disk('public')
                ->directory('documents')
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(10240)
                ->hint('PDF, DOC ou DOCX — max 10 Mo.'),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('file_type')
                    ->label('Type')
                    ->placeholder('pdf')
                    ->hint('Extension du fichier.'),
                Forms\Components\TextInput::make('file_size')
                    ->label('Taille (octets)')
                    ->numeric()
                    ->hint('Rempli automatiquement si laissé vide.'),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('file_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'pdf' => 'danger',
                        'doc', 'docx' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('downloads_count')
                    ->label('Téléch.')
                    ->numeric(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
