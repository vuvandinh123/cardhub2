@extends('layouts.app')

@section('title', "Danh sách xe | KIMAN")

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Danh sách xe | KIMAN',
        'meta_description' => 'Danh sách xe đang có tại KIMAN – đa dạng dòng xe, thông tin minh bạch, tư vấn tận tâm.',
        'meta_keywords' => 'KIMAN, danh sách xe, xe đã qua sử dụng, xe mới',
        'meta_image' => asset('images/logo.png'),
        'canonical_url' => route('cars.index'),
        'meta_type' => 'website',
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
<style>
    .car-card {
        transition: all 0.3s ease;
    }
    
    .car-card:hover {
        transform: translateY(-8px);
    }
    
    .car-image {
        position: relative;
        overflow: hidden;
    }
    
    .car-image img {
        transition: transform 0.5s ease;
    }
    
    .car-card:hover .car-image img {
        transform: scale(1.1);
    }
    
    .filter-badge {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    }
    
    .active-filter {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: white;
    }
</style>
@endsection

@section('content')
    @include('partials.header')

    <!-- Hero -->
    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10 md:py-14">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <nav class="text-xs md:text-sm text-gray-300 mb-3">
                        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                        <span class="mx-2 text-gray-500">/</span>
                        <span class="text-gray-200">Danh sách xe</span>
                    </nav>
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        Kho xe tại KIMAN
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Tìm chiếc xe phù hợp với nhu cầu của bạn
                    </h1>
                    <p class="text-gray-300 mt-3 text-sm md:text-base max-w-2xl">
                        Danh sách xe được KIMAN chọn lọc và kiểm tra kỹ lưỡng, thông tin minh bạch, dễ so sánh và lựa chọn.
                    </p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 md:p-5 w-full md:w-80 backdrop-blur-sm text-white">
                    <p class="text-xs text-gray-300 mb-3">Tổng quan nhanh</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Số xe hiện có</span>
                            <span class="font-semibold">{{ $cars->total() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Số chỗ phổ biến</span>
                            <span class="font-semibold">4–7 chỗ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300">Tình trạng</span>
                            <span class="font-semibold">Đa dạng lựa chọn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings -->
    <section class="py-10 md:py-14 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="w-full">
                @php
                    $view = request('view', 'list');
                    $currentSort = $filters['sort_by'] ?? 'newest';
                    $currentCategory = $filters['category'] ?? '';
                    $topCategories = collect($categories)->whereNull('parent_id');
                    $childCategories = collect($categories)->groupBy('parent_id');
                @endphp

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <h2 class="text-lg md:text-2xl font-extrabold text-gray-900">
                        {{ $cars->total() }} xe đang hiển thị
                    </h2>
                    <div class="flex items-center gap-3 flex-wrap justify-end">
                        <form method="GET" action="{{ route('cars.index') }}" class="flex items-center">
                            @foreach(request()->except(['category', 'catgory', 'page']) as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $item)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <select name="category" onchange="this.form.submit()"
                                    class="px-3 py-2 rounded-xl border border-gray-200 bg-white text-xs md:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-500">
                                <option value="">Tất cả danh mục</option>
                                @foreach($topCategories as $category)
                                    <option value="{{ $category->slug }}" {{ $currentCategory === $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @foreach(($childCategories->get($category->id) ?? collect()) as $child)
                                        <option value="{{ $child->slug }}" {{ $currentCategory === $child->slug ? 'selected' : '' }}>
                                            — {{ $child->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </form>
                        <div class="hidden md:inline-flex rounded-xl border border-gray-200 bg-white overflow-hidden text-xs">
                            <a href="{{ route('cars.index', array_merge(request()->except('view', 'page'), ['view' => 'list'])) }}"
                               class="px-3 py-2 font-semibold {{ $view === 'list' ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                Hiển thị ngang
                            </a>
                            <a href="{{ route('cars.index', array_merge(request()->except('view', 'page'), ['view' => 'grid'])) }}"
                               class="px-3 py-2 font-semibold {{ $view === 'grid' ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                Hiển thị lưới
                            </a>
                        </div>
                        <select onchange="window.location.href=this.value"
                                class="px-3 py-2 rounded-xl border border-gray-200 bg-white text-xs md:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-500">
                            <option value="{{ route('cars.index', array_merge(request()->except('sort_by', 'page'), ['sort_by' => 'newest', 'view' => $view])) }}" {{ $currentSort === 'newest' ? 'selected' : '' }}>
                                Mới nhất
                            </option>
                            <option value="{{ route('cars.index', array_merge(request()->except('sort_by', 'page'), ['sort_by' => 'price_asc', 'view' => $view])) }}" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>
                                Giá thấp → cao
                            </option>
                            <option value="{{ route('cars.index', array_merge(request()->except('sort_by', 'page'), ['sort_by' => 'price_desc', 'view' => $view])) }}" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>
                                Giá cao → thấp
                            </option>
                            <option value="{{ route('cars.index', array_merge(request()->except('sort_by', 'page'), ['sort_by' => 'year_desc', 'view' => $view])) }}" {{ $currentSort === 'year_desc' ? 'selected' : '' }}>
                                Năm mới nhất
                            </option>
                        </select>
                    </div>
                </div>

                @if($cars->count() > 0)
                    @if($view === 'grid')
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                            @foreach($cars as $car)
                                @php
                                    $priceText = $car->formatted_price;
                                @endphp
                                <article class="car-card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl">
                                    <a href="{{ route('cars.show', $car->slug) }}" class="block car-image h-48 bg-gray-100">
                                        <img src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&h=450&fit=crop' }}"
                                             alt="{{ $car->title }}"
                                             class="w-full h-full object-contain">
                                        @if($car->status === 'available')
                                            <span class="absolute top-3 right-3 px-3 py-1 rounded-full bg-emerald-500 text-white text-[11px] font-semibold">
                                                Có sẵn
                                            </span>
                                        @endif
                                        @if($car->year && $car->year >= date('Y') - 1)
                                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-orange-500 text-white text-[11px] font-semibold">
                                                {{ $car->year }}
                                            </span>
                                        @endif
                                    </a>
                                    <div class="p-4 md:p-5">
                                        <div class="flex items-center justify-between gap-3 mb-2">
                                            <p class="text-xs font-semibold text-gray-500 uppercase">
                                                {{ $car->brand->name ?? 'Không xác định' }}
                                            </p>
                                        </div>
                                        <h3 class="text-sm md:text-base font-extrabold text-gray-900 mb-2 line-clamp-2">
                                            <a href="{{ route('cars.show', $car->slug) }}">{{ $car->title }}</a>
                                        </h3>
                                        <div class="grid grid-cols-3 gap-2 text-[11px] text-gray-600 mb-3">
                                            <p>Mã lực: {{ $car->horsepower ?? '—' }}</p>
                                            <p>Mô men: {{ $car->torque ?? '—' }}</p>
                                            <p>Tiêu hao: {{ $car->fuel_consumption ?? '—' }}</p>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <div>
                                                <p class="text-[11px] text-gray-500">Giá dự kiến</p>
                                                <p class="text-base md:text-lg font-extrabold text-orange-600">
                                                    {{ $priceText }}
                                                </p>
                                            </div>
                                            <a href="{{ route('cars.show', $car->slug) }}"
                                               class="hidden md:inline-flex items-center px-3 py-2 rounded-xl text-xs font-semibold bg-gray-900 text-white hover:bg-black">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="space-y-5 mb-8">
                            @foreach($cars as $car)
                                @php
                                    $priceText = $car->formatted_price;
                                @endphp
                                <article class="car-card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl flex items-center flex-col md:flex-row">
                                    <a href="{{ route('cars.show', $car->slug) }}" class="car-image relative md:w-2/5 h-52 bg-gray-100">
                                        <img src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop' }}"
                                             alt="{{ $car->title }}"
                                             class="w-full h-full object-contain">
                                        @if($car->status === 'available')
                                            <span class="absolute top-3 right-3 px-3 py-1 rounded-full bg-emerald-500 text-white text-[11px] font-semibold">
                                                Có sẵn
                                            </span>
                                        @endif
                                        @if($car->year && $car->year >= date('Y') - 1)
                                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-orange-500 text-white text-[11px] font-semibold">
                                                {{ $car->year }}
                                            </span>
                                        @endif
                                    </a>
                                    <div class="p-4 md:p-6 flex-1 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between gap-3 mb-2">
                                                <p class="text-xs font-semibold text-gray-500 uppercase">
                                                    {{ $car->brand->name ?? 'Không xác định' }}
                                                </p>
                                            </div>
                                            <h3 class="text-base md:text-xl font-extrabold text-gray-900 mb-2">
                                                <a href="{{ route('cars.show', $car->slug) }}">{{ $car->title }}</a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                                {{ $car->description ?? 'Mẫu xe được KIMAN kiểm tra kỹ lưỡng, phù hợp nhiều nhu cầu sử dụng khác nhau.' }}
                                            </p>
                                            <div class="grid grid-cols-3 gap-3 text-xs text-gray-600">
                                                <p>Mã lực: {{ $car->horsepower ?? '—' }}</p>
                                                <p>Mô men: {{ $car->torque ?? '—' }}</p>
                                                <p>Tiêu hao: {{ $car->fuel_consumption ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
                                            <div>
                                                <p class="text-[11px] text-gray-500">Giá dự kiến</p>
                                                <p class="text-lg md:text-2xl font-extrabold text-orange-600">
                                                    {{ $priceText }}
                                                </p>
                                            </div>
                                            <a href="{{ route('cars.show', $car->slug) }}"
                                               class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-gray-900 text-white hover:bg-black whitespace-nowrap">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    @if($cars->hasPages())
                        <div class="mt-4">
                            {{ $cars->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white rounded-3xl shadow-md border border-gray-100 py-12 px-6 text-center">
                        <svg class="w-14 h-14 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg md:text-2xl font-extrabold text-gray-900 mb-2">Hiện chưa có xe phù hợp</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-5">
                            Hãy thử điều chỉnh lại bộ lọc, hoặc liên hệ trực tiếp với KIMAN để được tư vấn thêm.
                        </p>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <a href="{{ route('cars.index') }}"
                               class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold hover:bg-black">
                                Làm mới danh sách
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center px-5 py-2.5 rounded-xl border border-gray-300 text-sm font-semibold text-gray-800 hover:bg-gray-50">
                                Liên hệ KIMAN
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection

@section('scripts')
<script></script>
@endsection
