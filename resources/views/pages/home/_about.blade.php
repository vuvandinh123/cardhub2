<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div id="about-image">
                <div class="relative">
                    <img src="{{ asset("images/about.png") }}" alt="Showroom" class="rounded-2xl shadow-2xl">
                    <div class="absolute -bottom-6 -right-6 bg-orange-600 text-white p-8 rounded-2xl shadow-xl">
                        <h3 class="text-4xl font-bold">10+</h3>
                        <p class="text-orange-100">Năm Uy Tín</p>
                    </div>
                </div>
            </div>

            <div id="about-content">
                <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Về Chúng Tôi
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Đối Tác Tin Cậy Của <span class="text-orange-600">Doanh Nghiệp</span>
                </h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    KIMAN tự hào là đơn vị hàng đầu trong lĩnh vực phân phối xe đầu kéo cao cấp tại Việt Nam. Với hơn 10 năm kinh nghiệm, chúng tôi cam kết mang đến những sản phẩm chất lượng nhất cùng dịch vụ hậu mãi tận tâm.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Sản Phẩm Chính Hãng 100%</h4>
                            <p class="text-gray-600">Nhập khẩu trực tiếp từ các hãng xe uy tín hàng đầu thế giới</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Bảo Hành & Bảo Dưỡng Trọn Đời</h4>
                            <p class="text-gray-600">Chế độ bảo hành vượt trội với đội ngũ kỹ thuật chuyên nghiệp</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Hỗ Trợ Tài Chính Linh Hoạt</h4>
                            <p class="text-gray-600">Nhiều gói vay ưu đãi với lãi suất cạnh tranh nhất thị trường</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route("about") }}" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                    Tìm Hiểu Thêm →
                </a>
            </div>
        </div>
    </div>
</section>

