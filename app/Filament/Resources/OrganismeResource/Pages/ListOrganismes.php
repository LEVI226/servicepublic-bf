<?php
namespace App\Filament\Resources\OrganismeResource\Pages;
use App\Filament\Resources\OrganismeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganismes extends ListRecords
{
    protected static string $resource = OrganismeResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
