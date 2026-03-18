<?php

namespace App\Filament\Resources\AccessoryCategories\Schemas;

use App\Models\AccessoryCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AccessoryCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin cơ bản')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên danh mục')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn($state, callable $set) => $set('slug', Str::slug((string) $state))
                                    ),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(AccessoryCategory::class, 'slug', ignoreRecord: true)
                                    ->helperText('Chỉ gồm chữ thường, số và dấu gạch ngang'),

                                Select::make('parent_id')
                                    ->label('Danh mục cha')
                                    ->relationship('parent', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable()
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Mô tả')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(8),

                Group::make()
                    ->schema([
                        Section::make('Hiển thị')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->directory('accessory-categories/thumbnails')
                                    ->imageEditor(),

                                TextInput::make('sort_order')
                                    ->label('Thứ tự')
                                    ->numeric()
                                    ->default(0),

                                Toggle::make('is_active')
                                    ->label('Kích hoạt')
                                    ->default(true),
                            ]),

                        Section::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')->label('Meta title'),
                                TextInput::make('meta_description')->label('Meta description'),
                                TextInput::make('meta_keywords')->label('Meta keywords'),
                            ]),
                    ])
                    ->columnSpan(4),
            ]);
    }
}

