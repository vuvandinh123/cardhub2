<!-- Blog Section -->
<section id="blog" class="py-20 bg-gray-50">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                Tin Tức & Bài Viết
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Cập Nhật <span class="text-orange-600">Mới Nhất</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Tin tức ngành vận tải, hướng dẫn sử dụng và bảo dưỡng xe
            </p>
        </div>

        <div id="blog-grid" class="grid md:grid-cols-3 gap-8">
            @forelse ($posts as $post)
                <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden">
                        <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/400x250?text=' . urlencode($post->title) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                        @if($post->category)
                            <div class="absolute top-4 left-4 bg-orange-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $post->category->name }}
                            </div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                            <span>📅 {{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-orange-600 transition">
                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ $post->excerpt ? Str::limit($post->excerpt, 120) : Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-orange-600 font-semibold hover:text-orange-700 inline-flex items-center">
                            Đọc thêm
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Hiện chưa có bài viết nào được cập nhật.
                </div>
            @endforelse
        </div>
    </div>
</section>

