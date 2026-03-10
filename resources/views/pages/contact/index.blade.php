@extends('layouts.app')

@section('title', 'Liên hệ | KIMAN')
@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Liên hệ | KIMAN',
        'meta_description' => 'Liên hệ với KIMAN để được tư vấn và hỗ trợ nhanh chóng trong việc lựa chọn và mua xe phù hợp.',
        'meta_keywords' => 'KIMAN, liên hệ, tư vấn, hỗ trợ, mua xe',
        'meta_image' => asset('storage/default-image.jpg'),
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
                        Liên hệ KIMAN
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Kết nối nhanh với đội ngũ tư vấn KIMAN
                    </h1>
                    <p class="text-gray-300 mt-4 text-base md:text-lg leading-relaxed">
                        Bạn đang tìm chiếc xe phù hợp, cần tư vấn tài chính hay muốn tham khảo thêm lựa chọn?
                        Hãy để lại thông tin, đội ngũ KIMAN sẽ liên hệ lại trong thời gian sớm nhất.
                    </p>
                </div>
                <div class="grid sm:grid-cols-2 gap-4 w-full md:w-auto">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-white">
                        <p class="text-xs text-gray-300">Hotline</p>
                        <p class="text-lg font-semibold mt-1">0961549 241</p>
                        <p class="text-xs text-gray-400 mt-1">T2 – CN, 8:00 – 18:00</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-white">
                        <p class="text-xs text-gray-300">Email</p>
                        <p class="text-sm font-semibold mt-1 break-all">nguyenvanhop0403@icloud.com</p>
                        <p class="text-xs text-gray-400 mt-1">Phản hồi trong 24h</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-white">
                        <p class="text-xs text-gray-300">Showroom</p>
                        <p class="text-sm font-semibold mt-1">508 Quốc lộ 1A, Phường An Phú Đông, TP. HCM, Việt Nam</p>
                        <p class="text-xs text-gray-400 mt-1">Mở cửa cả Chủ nhật</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main contact -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Contact channels -->
                <div class="space-y-5">
                    <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Điện thoại</p>
                        <p class="text-lg font-bold text-gray-900">Gọi trực tiếp cho KIMAN</p>
                        <a href="tel:0961549241"
                           class="inline-flex items-center gap-2 mt-3 text-orange-600 font-semibold">
                            0961 549 241
                        </a>
                        <p class="text-xs text-gray-500 mt-2">T2 – CN: 8:00 – 18:00</p>
                    </div>
                    <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</p>
                        <p class="text-lg font-bold text-gray-900">Gửi yêu cầu chi tiết</p>
                        <a href="mailto:contact@carhub.vn"
                           class="inline-flex items-center gap-2 mt-3 text-gray-800 font-semibold break-all">
                            nguyenvanhop0403@icloud.com
                        </a>
                        <p class="text-xs text-gray-500 mt-2">Chúng tôi cố gắng phản hồi trong vòng 24h làm việc.</p>
                    </div>
                    <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Showroom</p>
                        <p class="text-lg font-bold text-gray-900">Trải nghiệm xe trực tiếp</p>
                        <p class="text-sm text-gray-700 mt-2">
                            508 Quốc lộ 1A, Phường An Phú Đông, TP. HCM, Việt Nam
                        </p>
                        <p class="text-xs text-gray-500 mt-2">Có hỗ trợ xem xe cuối tuần.</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 md:p-8">
                        <h2 class="text-xl md:text-2xl font-extrabold text-gray-900 mb-2">Gửi thông tin tư vấn</h2>
                        <p class="text-sm md:text-base text-gray-600 mb-6">
                            Hãy cho chúng tôi biết nhu cầu và ngân sách dự kiến, KIMAN sẽ gợi ý cho bạn những lựa chọn phù hợp nhất.
                        </p>

                        {{-- Flash messages --}}
                        @if(session('success'))
                            <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('consultation.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-xs font-semibold text-gray-700 mb-2">
                                        Họ và tên <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required
                                           value="{{ old('name') }}"
                                           class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-500 text-sm @error('name') border-red-400 @enderror"
                                           placeholder="Nhập họ tên của bạn">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone" class="block text-xs font-semibold text-gray-700 mb-2">
                                        Số điện thoại <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" required
                                           value="{{ old('phone') }}"
                                           class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-500 text-sm @error('phone') border-red-400 @enderror"
                                           placeholder="0123456789">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-semibold text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-500 text-sm @error('email') border-red-400 @enderror"
                                       placeholder="email@example.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-xs font-semibold text-gray-700 mb-2">
                                    Nhu cầu chính
                                </label>
                                <select id="subject" name="subject"
                                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-500 text-sm">
                                    <option value="">Chọn nhu cầu</option>
                                    <option value="buy" {{ old('subject') == 'buy' ? 'selected' : '' }}>Tư vấn mua xe</option>
                                    <option value="sell" {{ old('subject') == 'sell' ? 'selected' : '' }}>Tư vấn bán/đổi xe</option>
                                    <option value="service" {{ old('subject') == 'service' ? 'selected' : '' }}>Tư vấn chi phí & sử dụng</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-xs font-semibold text-gray-700 mb-2">
                                    Nội dung
                                </label>
                                <textarea id="message" name="note" rows="4"
                                          class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-500 text-sm resize-none @error('note') border-red-400 @enderror"
                                          placeholder="Mô tả ngắn gọn nhu cầu, dòng xe bạn quan tâm, ngân sách dự kiến...">{{ old('note') }}</textarea>
                                @error('note')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-3 rounded-xl transition">
                                Gửi yêu cầu tư vấn
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section class="pb-12 md:pb-16 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-6 md:p-7 border-b border-gray-100">
                    <h2 class="text-xl md:text-2xl font-extrabold text-gray-900">Vị trí showroom KIMAN</h2>
                    <p class="text-sm md:text-base text-gray-600 mt-1">
                        Ghé trực tiếp để xem xe, lái thử và được tư vấn chi tiết hơn.
                    </p>
                </div>
                <div class="h-[360px] md:h-[440px] bg-gray-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.3592884704285!2d106.69684327461411!3d10.860253689293634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175283dfc3f677f%3A0x3759a9ef8b49f7cc!2zNTA4IFFMMUEsIEFuIFBow7ogxJDDtG5nLCBRdeG6rW4gMTIsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCA3MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sjp!4v1773152052916!5m2!1svi!2sjp" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
