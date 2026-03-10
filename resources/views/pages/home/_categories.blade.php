<!-- Categories -->
<section id="categories" class="py-20 bg-gray-50">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                Danh Mục Sản Phẩm
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Dòng Xe <span class="text-orange-600">Đa Dạng</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Đáp ứng mọi nhu cầu vận tải từ nhẹ đến nặng với các dòng xe chất lượng cao
            </p>
        </div>

        <div id="categories-grid" class="grid md:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <div class="category-card group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition cursor-pointer">
                    <a href="{{ route('categories.show', $category->slug) }}" class="block relative overflow-hidden">
                        <img src="{{ $category->thumbnail ? asset('storage/' . $category->thumbnail) : 'https://via.placeholder.com/600x400?text=' . urlencode($category->name) }}"
                             alt="{{ $category->name }}"
                             class="w-full h-64 object-contain group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white text-2xl font-bold">{{ $category->name }}</h3>
                        </div>
                    </a>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">{{ $category->description ?? 'Khám phá các dòng xe thuộc danh mục ' . $category->name }}</p>
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-orange-600 font-semibold hover:text-orange-700 inline-flex items-center">
                            Xem chi tiết
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Hiện chưa có danh mục nào được cập nhật.
                </div>
            @endforelse
        </div>
    </div>
</section>

