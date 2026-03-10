@extends('layouts.app')

@section('title', $post->seo_title ?? $post->title)

@section('meta')
    @include('partials.meta-tag', [
        'title' => $post->seo_title ?? $post->title,
        'meta_description' => $post->seo_description ?? $post->excerpt,
        'meta_keywords' => $post->seo_keywords ?? '',
        'meta_image' => $post->thumbnail ?? asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
    ])
@endsection

@section('content')
    @include('partials.header')

    <!-- Hero -->
    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10 md:py-12">
            <div class="max-w-4xl">
                <nav class="mb-4 text-xs md:text-sm text-gray-300">
                    <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                    <span class="mx-2 text-gray-500">/</span>
                    <a href="{{ route('posts.index') }}" class="hover:text-white">Tin tức</a>
                    <span class="mx-2 text-gray-500">/</span>
                    <span class="text-gray-200">{{ Str::limit($post->title, 60) }}</span>
                </nav>

                @if($post->category)
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        {{ $post->category->name }}
                    </div>
                @endif

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 mt-4 text-xs md:text-sm text-gray-300">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ $post->published_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} phút đọc</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="py-10 md:py-12 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8">
                    @if($post->thumbnail)
                        <div class="mb-6 md:mb-8 rounded-3xl overflow-hidden shadow-lg bg-white">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-[240px] md:h-[320px] object-cover">
                        </div>
                    @endif

                    <article class="bg-white rounded-3xl shadow-lg border border-gray-100 p-5 md:p-7">
                        <div class="prose prose-sm md:prose-base max-w-none prose-img:rounded-2xl prose-headings:text-gray-900 prose-p:text-gray-700">
                            {!! $post->content !!}
                        </div>

                        @if($post->tags->count() > 0)
                            <div class="mt-8 pt-5 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">
                                    Tags
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('posts.index', ['tag' => $tag->id]) }}"
                                           class="px-3 py-1.5 rounded-full bg-gray-100 text-xs text-gray-800 hover:bg-gray-200">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>

                    <div class="mt-5 md:mt-7 flex flex-wrap items-center gap-3 justify-between">
                        <p class="text-xs text-gray-500">
                            Nếu thấy hữu ích, bạn có thể chia sẻ bài viết:
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#1877F2]/10 text-xs text-[#1877F2] font-semibold hover:bg-[#1877F2]/15">
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-sky-500/10 text-xs text-sky-600 font-semibold hover:bg-sky-500/15">
                                <span>Twitter</span>
                            </a>
                            <button type="button"
                                    onclick="copyPostLink()"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 text-xs text-gray-700 font-semibold hover:bg-gray-200">
                                <span>Sao chép link</span>
                            </button>
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-3xl shadow border border-gray-100 p-5">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">
                            Bài viết mới nhất
                        </h2>
                        <div class="space-y-4">
                            @foreach($latestPosts ?? [] as $latest)
                                <a href="{{ route('posts.show', $latest) }}" class="flex gap-3 group">
                                    @if($latest->thumbnail)
                                        <img src="{{ asset('storage/' . $latest->thumbnail) }}"
                                             alt="{{ $latest->title }}"
                                             onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                                             class="w-14 h-14 rounded-2xl object-cover group-hover:scale-105 transition-transform">
                                    @else
                                        <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center">
                                            <i data-lucide="newspaper" class="w-5 h-5 text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500">
                                            {{ $latest->published_at->format('d/m/Y') }}
                                        </p>
                                        <h3 class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-orange-600">
                                            {{ $latest->title }}
                                        </h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if($post->tags->count() > 0)
                        <div class="bg-white rounded-3xl shadow border border-gray-100 p-5">
                            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">
                                Chủ đề liên quan
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('posts.index', ['tag' => $tag->id]) }}"
                                       class="px-3 py-1.5 rounded-full bg-gray-100 text-xs text-gray-800 hover:bg-gray-200">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

    @if($relatedPosts->count() > 0)
        <section class="pb-12 md:pb-16 bg-gray-50">
            <div class="container max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between gap-3 mb-6">
                    <h2 class="text-xl md:text-2xl font-extrabold text-gray-900">
                        Bài viết liên quan
                    </h2>
                    <a href="{{ route('posts.index') }}"
                       class="text-xs md:text-sm font-semibold text-gray-600 hover:text-gray-900">
                        Xem tất cả
                    </a>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden group">
                            <a href="{{ route('posts.show', $relatedPost->slug) }}" class="block">
                                @if($relatedPost->thumbnail)
                                    <div class="relative h-44 overflow-hidden">
                                        <img src="{{ asset('storage/' . $relatedPost->thumbnail) }}"
                                             alt="{{ $relatedPost->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endif
                                <div class="p-4 md:p-5">
                                    @if($relatedPost->category)
                                        <p class="text-[11px] font-semibold text-orange-600 uppercase">
                                            {{ $relatedPost->category->name }}
                                        </p>
                                    @endif
                                    <h3 class="mt-1 text-sm md:text-base font-extrabold text-gray-900 line-clamp-2 group-hover:text-orange-600">
                                        {{ $relatedPost->title }}
                                    </h3>
                                    @if($relatedPost->excerpt)
                                        <p class="mt-2 text-xs md:text-sm text-gray-600 line-clamp-2">
                                            {{ $relatedPost->excerpt }}
                                        </p>
                                    @endif
                                    <p class="mt-3 text-[11px] text-gray-500">
                                        {{ $relatedPost->published_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.footer')
@endsection

@section('scripts')
<script>
    function copyPostLink() {
        const url = window.location.href;
        if (!navigator.clipboard) {
            window.prompt('Sao chép link bài viết:', url);
            return;
        }
        navigator.clipboard.writeText(url).then(() => {
            alert('Đã sao chép link bài viết vào bộ nhớ tạm.');
        }).catch(() => {
            window.prompt('Sao chép link bài viết:', url);
        });
    }
</script>
@endsection
