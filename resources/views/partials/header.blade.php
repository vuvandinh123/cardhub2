@php
    use App\Models\Category;
    use App\Models\Car;

    $headerCategories = $headerCategories
        ?? (class_exists(Category::class)
            ? Category::query()
                ->withCount('cars')
                ->orderBy('name')
                ->get()
            : collect());

    $headerCategoriesTop = $headerCategories->whereNull('parent_id');
    $headerCategoriesChildren = $headerCategories->groupBy('parent_id');

    // Featured cars grouped by category for mega menu
    $featuredCarsByCategory = [];
    foreach ($headerCategoriesTop as $cat) {
        $featuredCarsByCategory[$cat->id] = Car::whereHas('categories', function ($q) use ($cat) {
                $q->where('categories.id', $cat->id);
            })
            ->with('brand')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
    }
@endphp

<!-- Header -->
<header id="header" class="bg-white/95 backdrop-blur shadow-md fixed w-full top-0 z-50">
    <div class="container max-w-7xl mx-auto px-4 py-3 md:py-4">
        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div>
                    <img src="https://howokiman.vn/thumbs/206x40x2/upload/photo/2022-logo-chuan-03-6846.png" alt="KIMAN">
                    <p class="text-[10px] text-center text-yellow-600 uppercase tracking-wide">KHƠI NGUỒN TẠO KHÁC BIỆT</p>
                </div>
            </a>

            <!-- Desktop nav -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-8 text-sm">
                <a href="{{ route('home') }}" class="relative font-medium transition {{ request()->routeIs('home') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                    Trang Chủ
                    @if(request()->routeIs('home'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                </a>
                <a href="{{ route('about') }}" class="relative font-medium transition {{ request()->routeIs('about') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                    Giới Thiệu
                    @if(request()->routeIs('about'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                </a>

                <!-- Danh mục mega menu -->
                <div class="relative group">
                    <button type="button"
                            class="relative inline-flex items-center gap-1 font-medium transition {{ request()->routeIs('categories.*') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                        <span>Danh Mục</span>
                        <span class="text-xs">▾</span>
                        @if(request()->routeIs('categories.*'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                    </button>
                    @if($headerCategoriesTop->count())
                        <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 absolute -left-20 mt-3 bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 z-50"
                             style="width: max-content; max-width: 80vw;">
                            <div class="flex gap-5 overflow-x-auto">
                                @foreach($headerCategoriesTop as $cat)
                                    @php
                                        $children = $headerCategoriesChildren->get($cat->id) ?? collect();
                                        $count = $cat->cars_count ?? 0;
                                    @endphp
                                    <a href="{{ route('cars.index', ['category' => $cat->slug]) }}"
                                       class="flex-shrink-0 w-44 group/card rounded-xl overflow-hidden border border-gray-100 hover:border-orange-300 hover:shadow-lg transition-all duration-200">
                                        <div class="relative h-28 bg-gray-100 overflow-hidden">
                                            <img src="{{ $cat->thumbnail ? asset('storage/' . $cat->thumbnail) : 'https://via.placeholder.com/300x200?text=' . urlencode($cat->name) }}"
                                                 alt="{{ $cat->name }}"
                                                 class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-300">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                            <span class="absolute bottom-2 right-2 text-[10px] bg-orange-500 text-white px-2 py-0.5 rounded-full font-semibold">
                                                {{ $count }} xe
                                            </span>
                                        </div>
                                        <div class="p-3">
                                            <p class="text-sm font-bold text-gray-800 group-hover/card:text-orange-600 transition truncate">
                                                {{ $cat->name }}
                                            </p>
                                            @if($children->count())
                                                <p class="text-[11px] text-gray-500 truncate mt-1">
                                                    {{ $children->take(3)->pluck('name')->join(', ') }}
                                                </p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                                <a href="{{ route('categories.index') }}"
                                   class="text-sm text-orange-600 hover:text-orange-700 font-semibold inline-flex items-center gap-1">
                                    Xem tất cả danh mục
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sản phẩm mega menu -->
                <div class="relative group">
                    <button type="button"
                            class="relative inline-flex items-center gap-1 font-medium transition {{ request()->routeIs('cars.*') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                        <span>Sản Phẩm</span>
                        <span class="text-xs">▾</span>
                        @if(request()->routeIs('cars.*'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                    </button>
                    @if($headerCategoriesTop->count())
                        <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 fixed left-1/2 -translate-x-1/2 mt-3 bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 z-50"
                             style="width: min(90vw, 900px);">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-bold text-gray-800">Sản Phẩm Theo Danh Mục</h3>
                                <a href="{{ route('cars.index') }}" class="text-sm text-orange-600 hover:text-orange-700 font-semibold">Xem tất cả →</a>
                            </div>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($headerCategoriesTop->take(6) as $cat)
                                    @php $catCars = $featuredCarsByCategory[$cat->id] ?? collect(); @endphp
                                    <div>
                                        <a href="{{ route('cars.index', ['category' => $cat->slug]) }}"
                                           class="flex items-center gap-2 mb-2 pb-2 border-b border-gray-100 group/cat">
                                            <span class="w-2 h-2 rounded-full bg-orange-500 flex-shrink-0"></span>
                                            <span class="text-sm font-bold text-gray-800 group-hover/cat:text-orange-600 transition">{{ $cat->name }}</span>
                                            <span class="text-[10px] text-gray-400 ml-auto">{{ $cat->cars_count ?? 0 }} xe</span>
                                        </a>
                                        @if($catCars->count())
                                            <ul class="space-y-1">
                                                @foreach($catCars as $car)
                                                    <li>
                                                        <a href="{{ route('cars.show', $car->slug) }}"
                                                           class="flex items-center justify-between gap-2 px-2 py-1.5 rounded-lg hover:bg-orange-50 transition group/item">
                                                            <div class="min-w-0">
                                                                <p class="text-xs font-medium text-gray-700 group-hover/item:text-orange-600 truncate">{{ $car->title }}</p>
                                                                <p class="text-[10px] text-gray-400">{{ $car->brand->name ?? '' }}</p>
                                                            </div>
                                                            <span class="text-[11px] font-semibold text-orange-600 whitespace-nowrap">
                                                                {{ $car->formatted_price }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-[11px] text-gray-400 px-2 py-1">Chưa có sản phẩm</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <a href="{{ route('posts.index') }}" class="relative font-medium transition {{ request()->routeIs('posts.*') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                    Tin Tức
                    @if(request()->routeIs('posts.*'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                </a>
                <a href="{{ route('contact') }}" class="relative font-medium transition {{ request()->routeIs('contact') ? 'text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                    Liên Hệ
                    @if(request()->routeIs('contact'))<span class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 rounded-full"></span>@endif
                </a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('contact') }}" class="hidden md:inline-flex bg-gradient-to-r from-orange-500 to-orange-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:from-orange-600 hover:to-orange-700 transition shadow-md">
                    Liên Hệ Ngay
                </a>
                <!-- Mobile menu button -->
                <button type="button" class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 text-gray-700" id="mobileMenuToggle" aria-label="Mở menu">
                    ☰
                </button>
            </div>
        </div>

        <!-- Mobile nav -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-gray-100 mt-3 pt-3">
            <nav class="flex flex-col gap-1 text-sm pb-3">
                <a href="{{ route('home') }}" class="px-2 py-2 rounded-lg font-medium {{ request()->routeIs('home') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}">Trang Chủ</a>
                <a href="{{ route('about') }}" class="px-2 py-2 rounded-lg font-medium {{ request()->routeIs('about') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}">Giới Thiệu</a>

                <!-- Mobile Danh mục -->
                <button type="button"
                        class="flex items-center justify-between px-2 py-2 rounded-lg font-medium {{ request()->routeIs('categories.*') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}"
                        data-mobile-submenu-toggle="categories">
                    <span>Danh Mục</span>
                    <span class="text-xs">▾</span>
                </button>
                <div class="hidden pb-2" data-mobile-submenu="categories">
                    <div class="flex gap-3 overflow-x-auto py-2 px-1 -mx-1 scrollbar-thin">
                        @foreach($headerCategoriesTop as $cat)
                            <a href="{{ route('cars.index', ['category' => $cat->slug]) }}"
                               class="flex-shrink-0 w-32 rounded-xl overflow-hidden border border-gray-100 hover:border-orange-300 transition">
                                <div class="h-20 bg-gray-100 overflow-hidden">
                                    <img src="{{ $cat->thumbnail ? asset('storage/' . $cat->thumbnail) : 'https://via.placeholder.com/200x120?text=' . urlencode($cat->name) }}"
                                         alt="{{ $cat->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="p-2">
                                    <p class="text-xs font-semibold text-gray-800 truncate">{{ $cat->name }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $cat->cars_count ?? 0 }} xe</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile Sản phẩm -->
                <button type="button"
                        class="flex items-center justify-between px-2 py-2 rounded-lg font-medium {{ request()->routeIs('cars.*') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}"
                        data-mobile-submenu-toggle="products">
                    <span>Sản Phẩm</span>
                    <span class="text-xs">▾</span>
                </button>
                <div class="hidden pb-2" data-mobile-submenu="products">
                    <a href="{{ route('cars.index') }}" class="block px-3 py-2 text-xs font-semibold text-orange-600">Xem tất cả xe →</a>
                    @foreach($headerCategoriesTop->take(6) as $cat)
                        @php $catCars = $featuredCarsByCategory[$cat->id] ?? collect(); @endphp
                        <div class="mb-2">
                            <a href="{{ route('cars.index', ['category' => $cat->slug]) }}"
                               class="flex items-center gap-2 px-3 py-1.5 text-xs font-bold text-gray-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                {{ $cat->name }}
                                <span class="text-[10px] text-gray-400 font-normal">({{ $cat->cars_count ?? 0 }})</span>
                            </a>
                            @foreach($catCars->take(3) as $car)
                                <a href="{{ route('cars.show', $car->slug) }}"
                                   class="block px-6 py-1 text-[11px] text-gray-600 hover:text-orange-600 truncate">
                                    {{ $car->title }} — <span class="text-orange-600 font-medium">{{ $car->formatted_price }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('posts.index') }}" class="px-2 py-2 rounded-lg font-medium {{ request()->routeIs('posts.*') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}">Tin Tức</a>
                <a href="{{ route('contact') }}" class="px-2 py-2 rounded-lg font-medium {{ request()->routeIs('contact') ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' }}">Liên Hệ</a>

                <a href="{{ route('contact') }}" class="mt-2 inline-flex items-center justify-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-orange-600 hover:to-orange-700 transition shadow-md">
                    Liên Hệ Ngay
                </a>
            </nav>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('mobileMenuToggle');
        const menu = document.getElementById('mobileMenu');
        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        document.querySelectorAll('[data-mobile-submenu-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                const key = btn.getAttribute('data-mobile-submenu-toggle');
                const submenu = document.querySelector('[data-mobile-submenu="' + key + '"]');
                if (submenu) {
                    submenu.classList.toggle('hidden');
                }
            });
        });
    });
</script>
