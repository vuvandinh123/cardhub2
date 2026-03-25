@extends('layouts.app')

@section('title', 'Giới thiệu | KIMAN')
@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Giới thiệu | KIMAN',
        'meta_description' => 'Tìm hiểu về KIMAN – đơn vị tư vấn & phân phối ô tô với quy trình minh bạch, tận tâm và chuyên nghiệp.',
        'meta_keywords' => 'KIMAN, giới thiệu, tư vấn xe, ô tô',
        'meta_image' => asset('images/logo.png'),
    ])
@endsection
@section('content')
    @include('partials.header')

    <!-- Hero -->
    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-14 md:py-16">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 text-orange-300 text-xs font-semibold mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        Về KIMAN
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Trung tâm 4S uỷ quyền sinotruk tại hồ chí minh, cung cấp xe tải nặng.
                    </h1>
                    <p class="text-gray-300 mt-4 text-base md:text-lg leading-relaxed">
                        KIMAN là đơn vị tư vấn & phân phối ô tô với quy trình minh bạch, chú trọng trải nghiệm
                        khách hàng và dịch vụ hậu mãi dài lâu. Chúng tôi đồng hành cùng bạn từ lúc tham khảo,
                        lái thử, đến khi bàn giao và chăm sóc sau bán.
                    </p>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-orange-500/10 blur-3xl rounded-full"></div>
                    <div class="relative bg-gray-900/60 border border-white/10 rounded-3xl p-5 flex flex-col gap-4 shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Kinh nghiệm</p>
                                <p class="text-3xl font-extrabold text-white">10+ năm</p>
                            </div>
                            <div class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-300 text-xs font-semibold">
                                Tư vấn tận tâm
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3 text-sm text-gray-200">
                            <div class="bg-white/5 rounded-2xl p-3">
                                <p class="text-xs text-gray-400">Dòng xe</p>
                                <p class="font-semibold mt-1">Đa dạng</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-3">
                                <p class="text-xs text-gray-400">Thủ tục</p>
                                <p class="font-semibold mt-1">Nhanh gọn</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-3">
                                <p class="text-xs text-gray-400">Hỗ trợ</p>
                                <p class="font-semibold mt-1">Tài chính</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            KIMAN chú trọng tư vấn phù hợp nhu cầu & ngân sách thực tế của từng khách hàng.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4 space-y-14 md:space-y-16">
            <!-- Intro / Story -->
            <div class="grid lg:grid-cols-2 gap-10 items-start">
                <div class="space-y-4">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Câu chuyện KIMAN</h2>
                    <p class="text-gray-700 leading-relaxed">
                        KIMAN được xây dựng với mong muốn trở thành cầu nối đáng tin cậy giữa khách hàng và những
                        chiếc xe chất lượng. Thay vì chỉ tập trung vào bán hàng, chúng tôi đặt trọng tâm vào việc
                        lắng nghe, tư vấn kỹ lưỡng và đồng hành cùng khách hàng trong mọi quyết định.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Chúng tôi hiểu rằng mua xe là một quyết định lớn – liên quan đến tài chính, công việc và
                        cả cảm xúc. Vì vậy, mỗi chiếc xe được giới thiệu đều trải qua quy trình kiểm tra, sàng lọc
                        và thẩm định thông tin rõ ràng, minh bạch.
                    </p>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-3xl shadow-lg p-5 border border-gray-100">
                        <p class="text-xs font-semibold text-orange-500 uppercase tracking-wide mb-2">Sứ mệnh</p>
                        <p class="text-gray-800 text-sm leading-relaxed">
                            Mang đến trải nghiệm mua – bán – tư vấn xe chuyên nghiệp, minh bạch và dễ tiếp cận
                            cho mọi khách hàng, dù là lần đầu mua xe hay nâng cấp lên dòng xe cao cấp hơn.
                        </p>
                    </div>
                    <div class="bg-white rounded-3xl shadow-lg p-5 border border-gray-100">
                        <p class="text-xs font-semibold text-orange-500 uppercase tracking-wide mb-2">Tầm nhìn</p>
                        <p class="text-gray-800 text-sm leading-relaxed">
                            Trở thành thương hiệu được nhắc đến đầu tiên khi khách hàng nghĩ tới việc tìm mua
                            một chiếc xe phù hợp – đáng tin cậy về chất lượng, xứng đáng về giá trị.
                        </p>
                    </div>
                    <div class="bg-gray-900 rounded-3xl shadow-lg p-5 border border-gray-900 sm:col-span-2">
                        <p class="text-xs font-semibold text-emerald-300 uppercase tracking-wide mb-2">Giá trị cốt lõi</p>
                        <ul class="space-y-2 text-sm text-gray-100">
                            <li>• Minh bạch trong thông tin & quy trình.</li>
                            <li>• Tư vấn dựa trên nhu cầu thật, không chạy theo doanh số.</li>
                            <li>• Đồng hành dài lâu sau khi bàn giao xe.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Core values -->
            <div>
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Điều làm nên sự khác biệt</h2>
                        <p class="text-gray-600 mt-2">
                            KIMAN tập trung vào trải nghiệm tổng thể thay vì chỉ là một giao dịch mua bán đơn lẻ.
                        </p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 p-5 transition">
                        <p class="text-sm font-semibold text-orange-500 mb-2">Tư vấn đúng nhu cầu</p>
                        <p class="text-sm text-gray-700">
                            Đề xuất dòng xe phù hợp với mục đích sử dụng (gia đình, kinh doanh, di chuyển phố hay đường dài)
                            và khả năng tài chính thực tế.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 p-5 transition">
                        <p class="text-sm font-semibold text-orange-500 mb-2">Thông tin minh bạch</p>
                        <p class="text-sm text-gray-700">
                            Tình trạng xe, lịch sử sử dụng, chi phí dự kiến… được trình bày rõ ràng để khách hàng
                            dễ dàng so sánh và ra quyết định.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 p-5 transition">
                        <p class="text-sm font-semibold text-orange-500 mb-2">Hỗ trợ tài chính & hồ sơ</p>
                        <p class="text-sm text-gray-700">
                            Đồng hành chuẩn bị hồ sơ vay, đăng ký, đăng kiểm… giúp khách hàng tiết kiệm thời gian
                            và tránh rắc rối giấy tờ.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 p-5 transition">
                        <p class="text-sm font-semibold text-orange-500 mb-2">Chăm sóc sau bán</p>
                        <p class="text-sm text-gray-700">
                            Tư vấn bảo dưỡng định kỳ, chi phí sử dụng, kết nối dịch vụ kỹ thuật – giúp chiếc xe
                            luôn vận hành ổn định.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-3xl px-6 py-10 md:px-10 md:py-12 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold">Những con số biết nói</h2>
                        <p class="text-gray-300 mt-2 text-sm md:text-base max-w-xl">
                            Mỗi khách hàng hài lòng là một bước tiến của KIMAN. Chúng tôi liên tục cải thiện quy trình
                            để mang lại trải nghiệm tốt hơn qua từng năm.
                        </p>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-left">
                        <p class="text-3xl md:text-4xl font-extrabold mb-1" data-count="500">0+</p>
                        <p class="text-sm uppercase tracking-wide text-gray-400">Khách hàng đã tư vấn</p>
                    </div>
                    <div class="text-left">
                        <p class="text-3xl md:text-4xl font-extrabold mb-1" data-count="150">0+</p>
                        <p class="text-sm uppercase tracking-wide text-gray-400">Xe đã bàn giao</p>
                    </div>
                    <div class="text-left">
                        <p class="text-3xl md:text-4xl font-extrabold mb-1" data-count="20">0+</p>
                        <p class="text-sm uppercase tracking-wide text-gray-400">Đối tác & showroom</p>
                    </div>
                    <div class="text-left">
                        <p class="text-3xl md:text-4xl font-extrabold mb-1" data-count="95">0%</p>
                        <p class="text-sm uppercase tracking-wide text-gray-400">Tỷ lệ khách hài lòng</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        Bạn đang cân nhắc tìm một chiếc xe phù hợp?
                    </h2>
                    <p class="text-gray-700 mt-3 leading-relaxed">
                        Hãy để đội ngũ KIMAN lắng nghe nhu cầu, phân tích tài chính và gợi ý cho bạn những lựa chọn
                        hợp lý nhất. Chúng tôi luôn sẵn sàng hỗ trợ bạn qua điện thoại, tin nhắn hoặc trực tiếp tại showroom.
                    </p>
                </div>
                <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('contact') }}"
                           class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-xl font-semibold text-center hover:from-orange-600 hover:to-orange-700 transition">
                            Liên hệ tư vấn ngay
                        </a>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="tel:1900xxxx"
                               class="w-full border border-gray-200 text-gray-800 py-3 rounded-xl font-semibold text-center hover:bg-gray-50 transition text-sm">
                                Gọi hotline
                            </a>
                            <a href="{{ route('cars.index') }}"
                               class="w-full border border-gray-200 text-gray-800 py-3 rounded-xl font-semibold text-center hover:bg-gray-50 transition text-sm">
                                Xem danh sách xe
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const counters = document.querySelectorAll('[data-count]');
                if (!counters.length) return;

                const animateCounter = (counter) => {
                    const target = parseInt(counter.getAttribute('data-count'), 10) || 0;
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;

                    const updateCounter = () => {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current).toLocaleString('vi-VN') + (counter.textContent.includes('%') ? '%' : '+');
                            requestAnimationFrame(updateCounter);
                        } else {
                            const suffix = counter.textContent.includes('%') ? '%' : '+';
                            counter.textContent = target.toLocaleString('vi-VN') + suffix;
                        }
                    };

                    updateCounter();
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.4 });

                counters.forEach(counter => observer.observe(counter));
            });
        </script>
    @endpush
@endsection
