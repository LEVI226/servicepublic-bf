<?php
namespace App\Filament\Resources\OrganismeResource\Pages;
use App\Filament\Resources\OrganismeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganisme extends EditRecord
{
    protected static string $resource = OrganismeResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
