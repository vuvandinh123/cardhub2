<?php

namespace App\Filament\Resources\AccessoryCategories\Pages;

use App\Filament\Resources\AccessoryCategories\AccessoryCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessoryCategory extends EditRecord
{
    protected static string $resource = AccessoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

