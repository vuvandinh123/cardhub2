<?php

namespace App\Filament\Resources\Accessories\Schemas;

use App\Models\Accessory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AccessoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin phụ kiện')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên phụ kiện')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn($state, callable $set) => $set('slug', Str::slug((string) $state))
                                    ),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(Accessory::class, 'slug', ignoreRecord: true),

                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->unique(Accessory::class, 'sku', ignoreRecord: true)
                                    ->maxLength(100),

                                TextInput::make('price')
                                    ->label('Giá')
                                    ->numeric()
                                    ->prefix('VND'),

                                TextInput::make('quantity')
                                    ->label('Số lượng')
                                    ->numeric()
                                    ->default(0),

                                Select::make('accessory_category_id')
                                    ->label('Danh mục phụ kiện')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Select::make('car_id')
                                    ->label('Liên kết xe (tùy chọn)')
                                    ->relationship('car', 'title')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),

                                Textarea::make('description')
                                    ->label('Mô tả ngắn')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                RichEditor::make('content')
                                    ->label('Chi tiết phụ kiện')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Thư viện ảnh phụ kiện')
                            ->schema([
                                Repeater::make('images')
                                    ->label('Ảnh phụ kiện')
                                    ->relationship('images')
                                    ->schema([
                                        FileUpload::make('image_url')
                                            ->label('Ảnh')
                                            ->image()
                                            ->required()
                                            ->directory('accessories/gallery')
                                            ->imageEditor(),
                                        Toggle::make('is_primary')
                                            ->label('Ảnh chính')
                                            ->default(false),
                                        TextInput::make('sort_order')
                                            ->label('Thứ tự')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(0)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => ($state['is_primary'] ?? false) ? 'Ảnh chính' : 'Ảnh phụ'),
                            ]),
                    ])
                    ->columnSpan(8),

                Group::make()
                    ->schema([
                        Section::make('Hiển thị')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->directory('accessories/thumbnails')
                                    ->imageEditor(),

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

