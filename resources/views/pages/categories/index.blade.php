@extends('layouts.app')

@section('title', ($pageTitle ?? 'Danh mục xe') . ' | KIMAN')

@section('meta')
    @include('partials.meta-tag', [
        'title' => ($pageTitle ?? 'Danh mục xe') . ' | KIMAN',
        'meta_description' => 'Khám phá các danh mục xe tại KIMAN – được phân loại rõ ràng theo nhu cầu sử dụng.',
        'meta_keywords' => 'KIMAN, danh mục xe, phân loại xe',
        'meta_image' => asset('images/categories-banner.jpg'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
<style>
    .category-card {
        transition: all 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-8px);
    }
    
    .category-image {
        position: relative;
        overflow: hidden;
    }
    
    .category-image img {
        transition: transform 0.5s ease;
    }
    
    .category-card:hover .category-image img {
        transform: scale(1.1);
    }
    
    .stat-badge {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    }
</style>
@endsection

@section('content')
    @include('partials.header')

    <!-- Hero -->
    @php
        $categoriesCount = $categories->count();
    @endphp

    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10 md:py-14">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <nav class="text-xs md:text-sm text-gray-300 mb-3">
                        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                        <span class="mx-2 text-gray-500">/</span>
                        <span class="text-gray-200">Danh mục xe</span>
                    </nav>
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        Danh mục xe tại KIMAN
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Chọn loại xe phù hợp với nhu cầu thực tế của bạn
                    </h1>
                    <p class="text-gray-300 mt-3 text-sm md:text-base max-w-2xl">
                        Các danh mục được phân loại rõ theo mục đích sử dụng, giúp bạn nhanh chóng thu hẹp phạm vi
                        và tìm đúng dòng xe mình cần.
                    </p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 md:p-5 w-full md:w-96 backdrop-blur-sm text-white">
                    <p class="text-xs text-gray-300 mb-3">Tổng quan danh mục</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Số danh mục</span>
                            <span class="font-semibold">{{ $categoriesCount }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Xe / danh mục (ước tính)</span>
                            <span class="font-semibold">Tùy loại xe</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Tư vấn chọn danh mục</span>
                            <span class="font-semibold">KIMAN hỗ trợ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-10 md:py-14 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Tất cả danh mục xe</h2>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">
                        Mỗi danh mục đại diện cho một nhóm xe với công năng và tệp khách hàng khác nhau.
                    </p>
                </div>
                <form action="{{ route('categories.index') }}" method="GET" class="w-full md:w-72">
                    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-3 py-2">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Tìm theo tên danh mục..."
                            class="flex-1 text-sm border-none focus:outline-none focus:ring-0"
                        >
                        <button type="submit" class="text-xs font-semibold text-gray-700 hover:text-orange-600">
                            Tìm
                        </button>
                    </div>
                </form>
            </div>

            @if($categoriesCount > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($categories as $category)
                        @php
                            $thumb = $category->thumbnail
                                ? asset('storage/' . $category->thumbnail)
                                : 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&h=450&fit=crop';
                            $carsCount = $category->cars_count ?? 0;
                        @endphp
                        <article class="category-card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl">
                            <a href="{{ route('cars.index', ['category' => $category->slug]) }}" class="category-image block relative h-52 bg-gray-100">
                                <img src="{{ $thumb }}" alt="{{ $category->name }}" class="w-full h-full object-contain">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 md:p-5">
                                    <h3 class="text-lg md:text-xl font-extrabold text-white mb-1 line-clamp-1">
                                        {{ $category->name }}
                                    </h3>
                                    <div class="flex items-center justify-between gap-2 text-xs text-gray-100">
                                        <span class="px-2 py-1 rounded-full bg-white/10 backdrop-blur text-[11px] font-semibold">
                                            {{ $carsCount }} xe trong danh mục
                                        </span>
                                        <span class="text-[11px]">
                                            Nhấn để xem xe
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="p-4 md:p-5">
                                @if($category->description)
                                    <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                                        {{ $category->description }}
                                    </p>
                                @endif
                                <div class="flex items-center justify-between gap-3">
                                    <div class="text-xs text-gray-500">
                                        <p>Danh mục do KIMAN phân loại.</p>
                                        <p>Phù hợp nhiều tệp khách hàng khác nhau.</p>
                                    </div>
                                    <a href="{{ route('cars.index', ['category' => $category->slug]) }}"
                                       class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-gray-900 text-white text-xs font-semibold hover:bg-black whitespace-nowrap">
                                        Xem xe
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-md border border-gray-100 py-12 px-6 text-center">
                    <h3 class="text-lg md:text-2xl font-extrabold text-gray-900 mb-2">Hiện chưa có danh mục nào</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-5">
                        Khi bạn tạo các danh mục trong hệ thống, chúng sẽ được hiển thị tại đây.
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold hover:bg-black">
                        Liên hệ KIMAN để được hỗ trợ
                    </a>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')
@endsection

@section('scripts')
<script></script>
@endsection
