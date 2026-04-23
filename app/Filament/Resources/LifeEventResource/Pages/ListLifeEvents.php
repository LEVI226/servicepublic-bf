<?php
namespace App\Filament\Resources\LifeEventResource\Pages;
use App\Filament\Resources\LifeEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLifeEvents extends ListRecords
{
    protected static string $resource = LifeEventResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
