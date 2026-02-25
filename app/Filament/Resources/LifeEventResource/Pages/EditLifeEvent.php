<?php
namespace App\Filament\Resources\LifeEventResource\Pages;
use App\Filament\Resources\LifeEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLifeEvent extends EditRecord
{
    protected static string $resource = LifeEventResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
