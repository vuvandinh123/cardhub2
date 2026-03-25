@extends('layouts.app')

@section('title', 'Tin tức & bài viết | KIMAN')
@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Tin tức & bài viết | KIMAN',
        'meta_description' => 'Tổng hợp bài viết, kinh nghiệm và cập nhật thị trường xe từ KIMAN.',
        'meta_keywords' => 'KIMAN, tin tức ô tô, kinh nghiệm mua xe, thị trường xe',
        'meta_image' => asset('images/logo.png'),
        'meta_robots' => 'index, follow',
    ])
@endsection

@section('content')
    @include('partials.header')

    <!-- Hero -->
    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-12 md:py-16">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <div class="max-w-xl">
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        Góc chia sẻ từ KIMAN
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Bài viết & kinh nghiệm về xe dành cho bạn
                    </h1>
                    <p class="text-gray-300 mt-4 text-base md:text-lg leading-relaxed">
                        Tổng hợp các bài viết, đánh giá, kinh nghiệm sử dụng và cập nhật thị trường xe
                        để bạn có thêm góc nhìn trước khi quyết định.
                    </p>
                </div>
                <div class="w-full md:w-96">
                    <form action="{{ route('posts.index') }}" method="GET" class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
                        <p class="text-xs text-gray-300 mb-2">Tìm nhanh bài viết</p>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nhập từ khóa bạn quan tâm..."
                                class="flex-1 px-3 py-2 rounded-xl text-sm bg-gray-900/40 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400/60"
                            >
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:from-orange-600 hover:to-orange-700 transition">
                                Tìm
                            </button>
                        </div>
                        @if(request('category') || request('tag'))
                            <div class="mt-3 flex flex-wrap gap-2">
                                @if(request('category'))
                                    <span class="px-2 py-1 rounded-full bg-white/10 text-xs text-gray-100">
                                        Danh mục: {{ $categories->find(request('category'))->name ?? '—' }}
                                    </span>
                                @endif
                                @if(request('tag'))
                                    <span class="px-2 py-1 rounded-full bg-white/10 text-xs text-gray-100">
                                        Tag: {{ $tags->find(request('tag'))->name ?? '—' }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-4">
                <!-- Filters / Sidebar -->
                <aside class="lg:col-span-4 xl:col-span-3">
                    <div class="space-y-5 lg:sticky lg:top-28">
                        <div class="bg-white rounded-3xl shadow border border-gray-100 p-5">
                            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Danh mục</h2>
                            <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                                <a href="{{ route('posts.index') }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-xl text-sm {{ !request('category') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                    <span>Tất cả bài viết</span>
                                    <span class="text-xs px-2 py-0.5 rounded-full {{ !request('category') ? 'bg-white/10 text-gray-100' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $posts->total() }}
                                    </span>
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('posts.index', ['category' => $category->id] + request()->except('page')) }}"
                                       class="flex items-center justify-between px-3 py-2 rounded-xl text-sm {{ request('category') == $category->id ? 'bg-orange-50 text-orange-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                        <span>{{ $category->name }}</span>
                                        <span class="text-xs px-2 py-0.5 rounded-full {{ request('category') == $category->id ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $category->posts_count }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow border border-gray-100 p-5">
                            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Chủ đề nổi bật</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($tags as $tag)
                                    <a href="{{ route('posts.index', ['tag' => $tag->id] + request()->except('page')) }}"
                                       class="px-3 py-1.5 rounded-full text-xs font-medium {{ request('tag') == $tag->id ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @if($featuredPosts->count() > 0)
                            <div class="bg-gray-900 rounded-3xl shadow border border-gray-900 p-5 text-white">
                                <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wide mb-3">Bài viết nổi bật</h2>
                                <div class="space-y-4">
                                    @foreach($featuredPosts as $featured)
                                        <a href="{{ route('posts.show', $featured) }}" class="flex gap-3 group">
                                            @if($featured->thumbnail)
                                                <img src="{{ asset('storage/' . $featured->thumbnail) }}"
                                                     alt="{{ $featured->title }}"
                                                     onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                                                     class="w-16 h-16 rounded-xl object-cover group-hover:scale-105 transition-transform">
                                            @else
                                                <div class="w-16 h-16 rounded-xl bg-white/10 flex items-center justify-center">
                                                    <i data-lucide="newspaper" class="w-6 h-6 text-white/70"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-gray-400 mb-0.5">
                                                    {{ $featured->published_at->format('d/m/Y') }}
                                                </p>
                                                <h3 class="text-sm font-semibold line-clamp-2 group-hover:text-orange-300">
                                                    {{ $featured->title }}
                                                </h3>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>

                <!-- Posts list -->
                <main class="lg:col-span-8 xl:col-span-9">
                    @if(request('search') || request('category') || request('tag'))
                        <div class="mb-5 flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Đang lọc theo:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gray-900 text-white text-xs">
                                    "{{ request('search') }}"
                                    <a href="{{ route('posts.index', request()->except('search', 'page')) }}" class="hover:text-orange-300">
                                        ×
                                    </a>
                                </span>
                            @endif
                            @if(request('category'))
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs">
                                    {{ $categories->find(request('category'))->name ?? 'Danh mục' }}
                                    <a href="{{ route('posts.index', request()->except('category', 'page')) }}" class="hover:text-orange-500">
                                        ×
                                    </a>
                                </span>
                            @endif
                            @if(request('tag'))
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gray-200 text-gray-800 text-xs">
                                    {{ $tags->find(request('tag'))->name ?? 'Tag' }}
                                    <a href="{{ route('posts.index', request()->except('tag', 'page')) }}" class="hover:text-gray-600">
                                        ×
                                    </a>
                                </span>
                            @endif
                            <a href="{{ route('posts.index') }}" class="ml-auto text-xs font-medium text-gray-500 hover:text-gray-800">
                                Xóa tất cả
                            </a>
                        </div>
                    @endif

                    <div class="mb-6 flex items-center justify-between gap-3">
                        <h2 class="text-lg md:text-xl font-extrabold text-gray-900">
                            {{ $posts->total() }} bài viết
                        </h2>
                    </div>

                    @if($posts->count() > 0)
                        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                            @foreach($posts as $post)
                                <article class="group bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden flex flex-col">
                                    <a href="{{ route('posts.show', $post) }}" class="block relative overflow-hidden">
                                        @if($post->thumbnail)
                                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                                 alt="{{ $post->title }}"
                                                 onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                                                 class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-52 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-900 flex items-center justify-center">
                                                <i data-lucide="newspaper" class="w-12 h-12 text-white/60"></i>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </a>
                                    <div class="p-4 md:p-5 flex flex-col flex-1">
                                        <div class="flex items-center justify-between gap-3 mb-3">
                                            @if($post->category)
                                                <a href="{{ route('posts.index', ['category' => $post->category->id] + request()->except('page')) }}"
                                                   class="px-3 py-1 rounded-full bg-orange-50 text-orange-700 text-xs font-semibold">
                                                    {{ $post->category->name }}
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400">Không có danh mục</span>
                                            @endif
                                            <span class="text-xs text-gray-500">
                                                {{ $post->published_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <h3 class="text-base md:text-lg font-extrabold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                            <a href="{{ route('posts.show', $post) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        @if($post->excerpt)
                                            <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                                                {{ $post->excerpt }}
                                            </p>
                                        @endif
                                        @if($post->tags->count() > 0)
                                            <div class="flex flex-wrap gap-1.5 mb-3">
                                                @foreach($post->tags->take(3) as $tag)
                                                    <a href="{{ route('posts.index', ['tag' => $tag->id] + request()->except('page')) }}"
                                                       class="text-[11px] px-2 py-0.5 rounded-full bg-gray-100 text-gray-700">
                                                        #{{ $tag->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="mt-auto pt-1">
                                            <a href="{{ route('posts.show', $post) }}"
                                               class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-900 hover:text-orange-600">
                                                Đọc tiếp
                                                <span class="transition-transform group-hover:translate-x-0.5">→</span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        @if($posts->hasPages())
                            <div class="mt-6">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    @else
                        <div class="bg-white rounded-3xl border border-gray-100 p-10 text-center">
                            <div class="mb-4">
                                <i data-lucide="search-x" class="w-14 h-14 text-gray-300 mx-auto"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-extrabold text-gray-900 mb-2">Không tìm thấy bài viết phù hợp</h3>
                            <p class="text-sm text-gray-600 mb-5">
                                Thử thay đổi từ khóa tìm kiếm hoặc bỏ bớt bộ lọc hiện tại.
                            </p>
                            <a href="{{ route('posts.index') }}"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold hover:bg-black">
                                Xem tất cả bài viết
                            </a>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
