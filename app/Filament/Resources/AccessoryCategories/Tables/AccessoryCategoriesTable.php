<?php

namespace App\Filament\Resources\AccessoryCategories\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AccessoryCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.name')
                    ->label('Danh mục cha')
                    ->placeholder('Danh mục gốc'),
                TextColumn::make('accessories_count')
                    ->label('Phụ kiện')
                    ->counts('accessories')
                    ->badge(),
                ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('Danh mục cha')
                    ->relationship('parent', 'name'),
            ])
            ->recordActions([
                EditAction::make()->label('Sửa'),
                DeleteAction::make()->label('Xóa'),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()->label('Xóa đã chọn'),
            ])
            ->defaultSort('sort_order');
    }
}

