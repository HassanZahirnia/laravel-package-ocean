<?php

namespace App\Filament\Resources\Packages\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Packages\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackages extends ListRecords
{
    protected static string $resource = PackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
