<?php
namespace App\Filament\Resources\EserviceResource\Pages;
use App\Filament\Resources\EserviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEservices extends ListRecords
{
    protected static string $resource = EserviceResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
