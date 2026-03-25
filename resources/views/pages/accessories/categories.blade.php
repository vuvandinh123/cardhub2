@extends('layouts.app')

@section('title', 'Danh mục phụ kiện | KIMAN')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Danh mục phụ kiện | KIMAN',
        'meta_description' => 'Khám phá các danh mục phụ kiện ô tô tại KIMAN.',
        'meta_keywords' => 'KIMAN, danh mục phụ kiện, phụ kiện ô tô',
        'meta_image' => asset('images/logo.png'),
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
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <nav class="text-xs md:text-sm text-gray-300 mb-3">
                        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                        <span class="mx-2 text-gray-500">/</span>
                        <span class="text-gray-200">Danh mục phụ kiện</span>
                    </nav>
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        Hệ danh mục phụ kiện
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Chọn danh mục phụ kiện phù hợp
                    </h1>
                    <p class="text-gray-300 mt-3 text-sm md:text-base max-w-2xl">
                        Phụ kiện được sắp xếp theo nhóm công năng để bạn dễ tìm kiếm và so sánh.
                    </p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 md:p-5 w-full md:w-80 backdrop-blur-sm text-white">
                    <p class="text-xs text-gray-300 mb-3">Tổng quan</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-300">Danh mục đang có</span>
                        <span class="font-semibold">{{ $categories->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 md:py-14 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                    @php
                        $thumb = $resolveImage($category->thumbnail)
                            ?? 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=700&h=500&fit=crop';
                    @endphp
                    <article class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition">
                        <a href="{{ route('accessories.index', ['category' => $category->slug]) }}" class="block relative h-52">
                            <img src="{{ $thumb }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h2 class="text-xl font-extrabold text-white">{{ $category->name }}</h2>
                                <p class="text-xs text-gray-100 mt-1">
                                    {{ $category->accessories_count ?? 0 }} phụ kiện
                                </p>
                            </div>
                        </a>
                        <div class="p-5">
                            <p class="text-sm text-gray-600 line-clamp-3">
                                {{ $category->description ?: 'Danh mục phụ kiện dành cho các nhu cầu nâng cấp và bảo vệ xe.' }}
                            </p>
                            <a href="{{ route('accessories.index', ['category' => $category->slug]) }}"
                               class="mt-4 inline-flex items-center px-4 py-2 rounded-xl bg-gray-900 text-white text-xs font-semibold hover:bg-black">
                                Xem phụ kiện
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 bg-white rounded-3xl border border-gray-100 shadow p-10 text-center">
                        <h3 class="text-2xl font-bold text-gray-900">Chưa có danh mục phụ kiện</h3>
                        <p class="text-gray-600 mt-2">Bạn có thể tạo trong Filament để hiển thị ở đây.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection

