<?php

namespace App\Filament\Resources\Accessories\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AccessoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Tên phụ kiện')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->searchable(),
                TextColumn::make('car.title')
                    ->label('Xe liên kết')
                    ->placeholder('Không liên kết')
                    ->toggleable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Số lượng')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->filters([
                SelectFilter::make('accessory_category_id')
                    ->label('Danh mục')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                EditAction::make()->label('Sửa'),
                DeleteAction::make()->label('Xóa'),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()->label('Xóa đã chọn'),
            ])
            ->defaultSort('id', 'desc');
    }
}

