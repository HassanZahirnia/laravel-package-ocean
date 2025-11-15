<?php

namespace App\Filament\Resources\Packages\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Packages\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPackage extends EditRecord
{
    protected static string $resource = PackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
