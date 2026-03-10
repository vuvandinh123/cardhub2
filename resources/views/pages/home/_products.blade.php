<!-- Products -->
<section id="products" class="py-20 bg-white">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                Sản Phẩm Nổi Bật
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Xe Đầu Kéo <span class="text-orange-600">Cao Cấp</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Những dòng xe hàng đầu với công nghệ tiên tiến và hiệu suất vượt trội
            </p>
        </div>

        <div id="products-grid" class="grid md:grid-cols-3 gap-8">
            @forelse ($cars as $car)
                <div class="product-card bg-gray-50 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <a href="{{ route('cars.show', $car->slug) }}" class="block relative overflow-hidden">
                        <img
                            src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : 'https://via.placeholder.com/600x400' }}"
                            alt="{{ $car->title }}"
                            class="w-full h-64 object-contain group-hover:scale-110 transition duration-500"
                        >
                        @if($car->status === 'coming_soon')
                            <div class="absolute top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold">
                                Sắp Ra Mắt
                            </div>
                        @elseif($car->status === 'sold')
                            <div class="absolute top-4 right-4 bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-bold">
                                Đã Bán
                            </div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-orange-600 font-semibold">
                                {{ $car->brand->name ?? 'Không xác định' }}
                            </span>
                            @if($car->year)
                                <span class="text-sm text-gray-500">{{ $car->year }}</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            <a href="{{ route('cars.show', $car->slug) }}" class="hover:text-orange-600 transition">{{ $car->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ $car->description ? Str::limit($car->description, 100) : 'Mẫu xe chất lượng cao, hiệu suất ổn định, phù hợp nhiều nhu cầu vận tải.' }}
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-500">Động cơ</p>
                                <p class="font-bold text-gray-800">
                                    {{ $car->engine ?? 'Đang cập nhật' }}
                                </p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-500">Số chỗ</p>
                                <p class="font-bold text-gray-800">
                                    {{ $car->seats ? $car->seats . ' chỗ' : 'Đang cập nhật' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Giá từ</p>
                                <p class="text-2xl font-bold text-orange-600">
                                    {{ $car->formatted_price }}
                                </p>
                            </div>
                            <a href="{{ route('cars.show', $car->slug) }}"
                               class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                                Chi Tiết
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Hiện chưa có xe nào được cập nhật.
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('cars.index') }}"
               class="border-2 border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white px-8 py-4 rounded-lg font-semibold text-lg transition">
                Xem Tất Cả Sản Phẩm
            </a>
        </div>
    </div>
</section>

