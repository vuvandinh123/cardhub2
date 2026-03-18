<!-- Hero Slider -->
<section id="slider" class="mt-20 relative overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
    <div class="container max-w-7xl mx-auto px-4 py-24 md:py-32">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div id="slider-content" class="text-white">
                <div
                    class="inline-block bg-orange-500/20 text-orange-400 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                    🚚 Chất Lượng Hàng Đầu Việt Nam
                </div>
                <h2 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Xe Đầu Kéo<br />
                    <span class="text-orange-500">Cao Cấp 2026</span>
                </h2>
                <p class="text-xl text-gray-300 mb-8">
                    Mạnh mẽ, bền bỉ, tiết kiệm nhiên liệu. Đáp ứng mọi nhu cầu vận chuyển hàng hóa của bạn với công nghệ
                    hiện đại nhất.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('cars.index') }}"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-4 rounded-lg font-semibold text-lg shadow-xl transition transform hover:scale-105">
                        Xem Sản Phẩm
                    </a>
                    <a href="{{ route('contact') }}"
                        class="border-2 border-white hover:bg-white hover:text-gray-900 text-white px-8 py-4 rounded-lg font-semibold text-lg transition">
                        Tư Vấn Miễn Phí
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-gray-700">
                    <div>
                        <h3 class="text-3xl font-bold text-orange-500">10+</h3>
                        <p class="text-gray-400">Năm Kinh Nghiệm</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-orange-500">999+</h3>
                        <p class="text-gray-400">Khách Hàng</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-orange-500">100%</h3>
                        <p class="text-gray-400">Hài Lòng</p>
                    </div>
                </div>
            </div>

            <div id="slider-image" class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-transparent flex items-center justify-center rounded-3xl"></div>
                <img src="{{ asset('images/banner.png') }}" alt="Xe đầu kéo"
                    class="rounded-3xl h-[420px] shadow-2xl object-cover w-full">
                <div class="absolute bottom-8 left-8 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-xl">
                    <p class="text-sm text-gray-600 mb-1">Giá chỉ từ</p>
                    <p class="text-3xl font-bold text-orange-600">1.2 tỷ VNĐ</p>
                </div>
            </div>
        </div>
    </div>
</section>
