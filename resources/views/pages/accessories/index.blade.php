@extends('layouts.app')

@section('title', 'Tất cả phụ kiện | KIMAN')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Tất cả phụ kiện | KIMAN',
        'meta_description' => 'Danh sách phụ kiện ô tô tại KIMAN.',
        'meta_keywords' => 'KIMAN, phụ kiện ô tô, đồ chơi xe',
        'meta_image' => asset('images/logo.png'),
        'canonical_url' => route('accessories.index'),
        'meta_type' => 'website',
    ])
@endsection

@section('content')
    @php
        $resolveImage = function ($path) {
            if (!$path) return null;
            if (preg_match('~^https?://~', $path)) return $path;
            return asset('storage/' . ltrim($path, '/'));
        };
    @endphp

    @include('partials.header')

    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10 md:py-14">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">Tất cả phụ kiện</h1>
            <p class="text-gray-300 mt-2">Tìm kiếm và chọn phụ kiện phù hợp cho chiếc xe của bạn.</p>
        </div>
    </section>

    <section class="py-8 md:py-10 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <form action="{{ route('accessories.index') }}" method="GET"
                  class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 md:p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-5">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Tìm phụ kiện, mã SKU..."
                               class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none">
                    </div>
                    <div class="md:col-span-3">
                        <select name="category"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none">
                            <option value="">Tất cả danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ $selectedCategory === $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <select name="sort_by"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none">
                            <option value="newest" {{ $sortBy === 'newest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_asc" {{ $sortBy === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <option value="price_desc" {{ $sortBy === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit"
                                class="flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:from-orange-600 hover:to-orange-700">
                            Lọc
                        </button>
                        <a href="{{ route('accessories.index') }}"
                           class="inline-flex items-center justify-center px-3 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm hover:bg-gray-50">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <div class="mb-5 text-sm text-gray-600">
                Tìm thấy <span class="font-semibold text-gray-900">{{ $accessories->total() }}</span> phụ kiện
            </div>

            @if($accessories->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($accessories as $item)
                        @php
                            $primary = $item->primaryImage?->image_url ?? $item->thumbnail;
                            $thumb = $resolveImage($primary) ?? 'https://images.unsplash.com/photo-1580274455191-1c62238fa333?w=700&h=500&fit=crop';
                        @endphp
                        <article class="bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl transition">
                            <a href="{{ route('accessories.show', $item->slug) }}" class="block h-48">
                                <img src="{{ $thumb }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            </a>
                            <div class="p-5">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-xs text-orange-600 font-semibold">
                                        {{ $item->category->name ?? 'Không phân loại' }}
                                    </p>
                                    @if($item->sku)
                                        <p class="text-[11px] text-gray-500">SKU: {{ $item->sku }}</p>
                                    @endif
                                </div>
                                <h2 class="text-lg font-extrabold text-gray-900 mt-1 line-clamp-2">
                                    <a href="{{ route('accessories.show', $item->slug) }}">{{ $item->name }}</a>
                                </h2>
                                <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                    {{ $item->description ?: 'Phụ kiện chất lượng, phù hợp nâng cấp và bảo vệ xe.' }}
                                </p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[11px] text-gray-500">Giá</p>
                                        <p class="text-lg font-extrabold text-orange-600">
                                            {{ $item->price ? number_format($item->price, 0, ',', '.') . ' ₫' : 'Liên hệ' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('accessories.show', $item->slug) }}"
                                       class="px-4 py-2 rounded-xl bg-gray-900 text-white text-xs font-semibold hover:bg-black">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $accessories->links() }}
                </div>
            @else
                <div class="bg-white rounded-3xl border border-gray-100 shadow p-10 text-center">
                    <h3 class="text-2xl font-bold text-gray-900">Không tìm thấy phụ kiện</h3>
                    <p class="text-gray-600 mt-2">Hãy thử từ khóa hoặc bộ lọc khác.</p>
                    <a href="{{ route('accessories.index') }}"
                       class="inline-flex mt-5 px-5 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold hover:bg-black">
                        Xem tất cả phụ kiện
                    </a>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')
@endsection

