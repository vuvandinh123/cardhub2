<?php

namespace App\Filament\Resources\AccessoryCategories\Pages;

use App\Filament\Resources\AccessoryCategories\AccessoryCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessoryCategories extends ListRecords
{
    protected static string $resource = AccessoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

