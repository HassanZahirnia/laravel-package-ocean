<?php

namespace App\Filament\Resources\Packages\Pages;

use App\Filament\Resources\Packages\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePackage extends CreateRecord
{
    protected static string $resource = PackageResource::class;
}
