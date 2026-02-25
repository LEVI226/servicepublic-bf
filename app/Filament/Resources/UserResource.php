<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?string $navigationLabel = 'Utilisateurs';
    protected static ?string $modelLabel = 'Utilisateur';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('prenom')->required(),
                    Forms\Components\TextInput::make('nom')->required(),
                ]),
                Forms\Components\TextInput::make('email')->required()->email()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('telephone')->tel(),
                Forms\Components\Select::make('role')->options([
                    'admin' => '🔴 Administrateur',
                    'editeur' => '🟡 Éditeur',
                    'contributeur' => '🟢 Contributeur',
                    'citoyen' => '⚪ Citoyen',
                ])->required()->default('contributeur'),
                Forms\Components\TextInput::make('password')->password()
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->label(fn (string $operation): string => $operation === 'create' ? 'Mot de passe' : 'Nouveau mot de passe (laisser vide pour ne pas modifier)'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nom_complet')->label('Nom')->searchable(['nom', 'prenom'])->sortable('nom'),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\BadgeColumn::make('role')->colors([
                'danger' => 'admin', 'warning' => 'editeur', 'success' => 'contributeur', 'gray' => 'citoyen',
            ]),
            Tables\Columns\TextColumn::make('created_at')->label('Inscrit le')->date('d/m/Y')->sortable(),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}