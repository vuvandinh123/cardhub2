<!-- Contact Section -->
<section id="contact" class="py-20 bg-white">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div id="contact-info">
                <div class="inline-block bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Liên Hệ Với Chúng Tôi
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Sẵn Sàng <span class="text-orange-600">Tư Vấn</span> Miễn Phí
                </h2>
                <p class="text-gray-600 text-lg mb-8">
                    Đội ngũ chuyên viên của chúng tôi luôn sẵn sàng tư vấn và hỗ trợ bạn tìm được chiếc xe đầu kéo phù hợp nhất
                </p>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Hotline</h4>
                            <p class="text-orange-600 text-xl font-bold">1900 xxxx</p>
                            <p class="text-gray-600 text-sm">Hỗ trợ 24/7</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                            <p class="text-orange-600 text-lg font-semibold">info@truckpro.vn</p>
                            <p class="text-gray-600 text-sm">Phản hồi trong 24h</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Showroom</h4>
                            <p class="text-gray-700">508 Quốc lộ 1A, Phường An Phú Đông, TP. HCM, Việt Nam</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contact-form" class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-3xl shadow-xl">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Đăng Ký Tư Vấn</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Họ và Tên</label>
                        <input type="text"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition"
                               placeholder="Nguyễn Văn A">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Số Điện Thoại</label>
                        <input type="tel"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition"
                               placeholder="0909 xxx xxx">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition"
                               placeholder="email@example.com">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Loại Xe Quan Tâm</label>
                        <select
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition">
                            <option value="">Chọn loại xe</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Lời Nhắn</label>
                        <textarea rows="4"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition"
                                  placeholder="Để lại lời nhắn của bạn..."></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-4 rounded-lg font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                        Gửi Yêu Cầu Tư Vấn
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

