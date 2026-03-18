<?php

namespace App\Filament\Resources\AccessoryCategories;

use App\Filament\Resources\AccessoryCategories\Pages\CreateAccessoryCategory;
use App\Filament\Resources\AccessoryCategories\Pages\EditAccessoryCategory;
use App\Filament\Resources\AccessoryCategories\Pages\ListAccessoryCategories;
use App\Filament\Resources\AccessoryCategories\Schemas\AccessoryCategoryForm;
use App\Filament\Resources\AccessoryCategories\Tables\AccessoryCategoriesTable;
use App\Models\AccessoryCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AccessoryCategoryResource extends Resource
{
    protected static ?string $model = AccessoryCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Squares2x2;

    protected static ?string $navigationLabel = 'Danh mục phụ kiện';

    protected static string|\UnitEnum|null $navigationGroup = 'Quản lý phụ kiện';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Danh mục phụ kiện';

    protected static ?string $pluralModelLabel = 'Danh sách danh mục phụ kiện';

    public static function form(Schema $schema): Schema
    {
        return AccessoryCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccessoryCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccessoryCategories::route('/'),
            'create' => CreateAccessoryCategory::route('/create'),
            'edit' => EditAccessoryCategory::route('/{record}/edit'),
        ];
    }
}

