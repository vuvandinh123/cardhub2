@extends('layouts.app')

@section('title', ($car->meta_title ?? $car->title) . ' | KIMAN')

@section('meta')
    @include('partials.meta-tag', [
        'title' => ($car->meta_title ?? $car->title) . ' | KIMAN',
        'meta_description' => $car->meta_description ?? Str::limit(strip_tags($car->description ?? ''), 160),
        'meta_keywords' => $car->meta_keywords ?? '',
        'meta_image' => $car->thumbnail ? asset('storage/' . $car->thumbnail) : asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css">
    <style>
        .spec-table td {
            padding: 12px 16px;
        }

        .car-main-swiper {
            width: 100%;
            height: 380px;
        }

        @media (min-width: 768px) {
            .car-main-swiper {
                height: 520px;
            }
        }

        .car-main-swiper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: zoom-in;
        }

        .car-main-swiper a {
            display: block;
            width: 100%;
            height: 100%;
        }

        .car-thumbs-swiper {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .car-thumbs-swiper .swiper-slide {
            width: 96px;
            height: 64px;
            opacity: 0.6;
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .car-thumbs-swiper .swiper-slide-thumb-active {
            opacity: 1;
            border-color: #f97316; /* orange-500 */
        }

        .car-thumbs-swiper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    @php
        $resolveImage = function ($path) {
            if (!$path) return null;
            if (preg_match('~^https?://~', $path)) return $path;
            return asset('storage/' . ltrim($path, '/'));
        };

        $primaryPath = $car->primaryImage?->image_url
            ?? $car->images->first()?->image_url
            ?? $car->thumbnail;
        $primaryImageUrl = $resolveImage($primaryPath) ?? 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=900&h=700&fit=crop';

        $priceText = $car->formatted_price;
        $statusMap = [
            'available' => ['label' => 'Có sẵn', 'class' => 'bg-green-100 text-green-700'],
            'sold' => ['label' => 'Đã bán', 'class' => 'bg-gray-200 text-gray-700'],
            'coming_soon' => ['label' => 'Sắp ra mắt', 'class' => 'bg-blue-100 text-blue-700'],
        ];
        $status = $statusMap[$car->status] ?? ['label' => $car->status, 'class' => 'bg-gray-100 text-gray-700'];
    @endphp

    @include('partials.header')

    <!-- Hero -->
    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10">
            <div class="flex flex-col gap-4">
                <nav class="text-sm text-gray-300">
                    <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                    <span class="mx-2 text-gray-500">/</span>
                    <a href="{{ route('cars.index') }}" class="hover:text-white">Danh sách xe</a>
                    <span class="mx-2 text-gray-500">/</span>
                    <span class="text-gray-200">{{ $car->title }}</span>
                </nav>
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full {{ $status['class'] }} text-sm font-semibold">
                            <span>{{ $status['label'] }}</span>
                            @if($car->year)
                                <span class="text-xs opacity-80">• {{ $car->year }}</span>
                            @endif
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-3 leading-tight">
                            {{ $car->title }}
                        </h1>
                        <p class="text-gray-300 mt-2">
                            {{ $car->brand->name ?? 'Không xác định' }}
                            @if($car->fuel)
                                <span class="text-gray-500 mx-2">•</span> {{ $car->fuel }}
                            @endif
                            @if($car->engine)
                                <span class="text-gray-500 mx-2">•</span> {{ $car->engine }}
                            @endif
                        </p>
                    </div>
                    <div class="text-white">
                        <p class="text-sm text-gray-300">Giá</p>
                        <p class="text-3xl font-extrabold text-orange-400">{{ $priceText }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main -->
    <section class="py-10 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Gallery -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                        <div class="relative">
                            <div class="swiper car-main-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a data-fancybox="car-gallery" href="{{ $primaryImageUrl }}">
                                            <img class="object-contain" src="{{ $primaryImageUrl }}" alt="{{ $car->title }}">
                                        </a>
                                    </div>
                                    @foreach($car->images as $image)
                                        @php $url = $resolveImage($image->image_url); @endphp
                                        @if($url && $url !== $primaryImageUrl)
                                            <div class="swiper-slide py-2">
                                                <a data-fancybox="car-gallery" href="{{ $url }}">
                                                    <img class="object-contain" src="{{ $url }}" alt="{{ $car->title }}">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="swiper-button-next !text-white"></div>
                                <div class="swiper-button-prev !text-white"></div>
                                <div class="swiper-pagination !bottom-3"></div>
                            </div>

                            @if($car->mileage !== null)
                                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-4 py-2 rounded-xl shadow">
                                    <p class="text-xs text-gray-500">Odo</p>
                                    <p class="text-sm font-bold text-gray-800">
                                        {{ number_format($car->mileage, 0, ',', '.') }} km
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if($car->images->count() > 0)
                            <div class="p-4 border-t bg-gray-50">
                                <div class="swiper car-thumbs-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{ $primaryImageUrl }}" alt="{{ $car->title }}">
                                        </div>
                                        @foreach($car->images as $image)
                                            @php $url = $resolveImage($image->image_url); @endphp
                                            @if($url && $url !== $primaryImageUrl)
                                            <div class="swiper-slide">
                                                <img src="{{ $url }}" alt="{{ $car->title }}">
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Highlights -->
                    <div class="grid sm:grid-cols-2 gap-4 mt-6">
                        <div class="bg-white rounded-2xl shadow p-5">
                            <p class="text-sm text-gray-500 mb-1">Điểm nổi bật</p>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span>{{ $car->year ? 'Năm sản xuất ' . $car->year : 'Năm sản xuất đang cập nhật' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span>{{ $car->horsepower ? 'Mã lực ' . $car->horsepower : 'Mã lực đang cập nhật' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span>{{ $car->torque ? 'Mô men xoắn ' . $car->torque : 'Mô men xoắn đang cập nhật' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span>{{ $car->fuel_consumption ? 'Tiêu hao NL ' . $car->fuel_consumption : 'Tiêu hao NL đang cập nhật' }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white rounded-2xl shadow p-5">
                            <p class="text-sm text-gray-500 mb-1">Cam kết</p>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-green-500"></span>
                                    <span>Hỗ trợ tư vấn & báo giá nhanh</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-green-500"></span>
                                    <span>Kiểm tra xe trước khi bàn giao</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-green-500"></span>
                                    <span>Hỗ trợ hồ sơ vay/đăng ký nếu cần</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Mô tả</h2>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $car->description ?: 'Hiện chưa có mô tả cho mẫu xe này.' }}
                        </p>

                        @if(!empty($car->content))
                            <div class="mt-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-3">Thông tin chi tiết</h3>
                                <div class="prose max-w-none">
                                    {!! $car->content !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Specifications -->
                    <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Thông số kỹ thuật</h2>
                        <div class="overflow-hidden rounded-2xl border">
                            <table class="w-full text-sm spec-table">
                                <tbody class="divide-y">
                                    <tr class="bg-gray-50">
                                        <td class="font-semibold text-gray-700 w-1/3">Hãng</td>
                                        <td class="text-gray-700">{{ $car->brand->name ?? 'Không xác định' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-gray-700">Năm</td>
                                        <td class="text-gray-700">{{ $car->year ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="font-semibold text-gray-700">Nhiên liệu</td>
                                        <td class="text-gray-700">{{ $car->fuel ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-gray-700">Động cơ</td>
                                        <td class="text-gray-700">{{ $car->engine ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="font-semibold text-gray-700">Mã lực</td>
                                        <td class="text-gray-700">{{ $car->horsepower ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-gray-700">Mô men xoắn</td>
                                        <td class="text-gray-700">{{ $car->torque ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="font-semibold text-gray-700">Tiêu hao NL</td>
                                        <td class="text-gray-700">{{ $car->fuel_consumption ?? 'Đang cập nhật' }}</td>
                                    </tr>
                                    @if($car->mileage !== null)
                                        <tr>
                                            <td class="font-semibold text-gray-700">Odo</td>
                                            <td class="text-gray-700">{{ number_format($car->mileage, 0, ',', '.') }} km</td>
                                        </tr>
                                    @endif

                                    @foreach($car->specifications as $spec)
                                        <tr class="{{ $loop->odd ? 'bg-gray-50' : '' }}">
                                            <td class="font-semibold text-gray-700">{{ $spec->name }}</td>
                                            <td class="text-gray-700">{{ $spec->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sticky summary / CTA -->
                <div class="lg:col-span-5">
                    <div class="lg:sticky lg:top-28 space-y-6">
                        <div class="bg-white rounded-3xl shadow-lg p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Giá bán</p>
                                    <p class="text-3xl font-extrabold text-orange-600">{{ $priceText }}</p>
                                </div>
                                <div class="px-3 py-1 rounded-full {{ $status['class'] }} text-sm font-semibold">
                                    {{ $status['label'] }}
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-xs text-gray-500">Năm</p>
                                    <p class="font-bold text-gray-800">{{ $car->year ?? '—' }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-xs text-gray-500">Mã lực</p>
                                    <p class="font-bold text-gray-800">{{ $car->horsepower ?? '—' }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-xs text-gray-500">Mô men xoắn</p>
                                    <p class="font-bold text-gray-800">{{ $car->torque ?? '—' }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-xs text-gray-500">Tiêu hao NL</p>
                                    <p class="font-bold text-gray-800">{{ $car->fuel_consumption ?? '—' }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 mt-6">
                                <a href="{{ route('contact') }}"
                                   class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-xl font-semibold text-center hover:from-orange-600 hover:to-orange-700 transition">
                                    Nhận tư vấn & báo giá
                                </a>
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="tel:0961549241"
                                       class="w-full border border-gray-200 text-gray-800 py-3 rounded-xl font-semibold text-center hover:bg-gray-50 transition">
                                        Gọi hotline
                                    </a>
                                    <a href="{{ route('cars.index') }}"
                                       class="w-full border border-gray-200 text-gray-800 py-3 rounded-xl font-semibold text-center hover:bg-gray-50 transition">
                                        Xem thêm xe
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-3">Bạn cần hỗ trợ nhanh?</h3>
                            <p class="text-gray-600 text-sm mb-4">
                                Gửi thông tin, đội ngũ KIMAN sẽ liên hệ trong thời gian sớm nhất.
                            </p>
                            @if(Route::has('consultation.store.car'))
                                <form action="{{ route('consultation.store.car', $car) }}" method="POST" class="space-y-3">
                                    @csrf
                                    <input name="name" type="text" required placeholder="Họ và tên"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none">
                                    <input name="phone" type="tel" required placeholder="Số điện thoại"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none">
                                    <button type="submit"
                                            class="w-full bg-gray-900 text-white py-3 rounded-xl font-semibold hover:bg-black transition">
                                        Gửi yêu cầu
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('contact') }}"
                                   class="inline-flex items-center justify-center w-full bg-gray-900 text-white py-3 rounded-xl font-semibold hover:bg-black transition">
                                    Mở trang liên hệ
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related -->
            @if(!empty($relatedCars) && $relatedCars->count() > 0)
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-gray-800">Xe liên quan</h2>
                        <a href="{{ route('cars.index') }}" class="text-orange-600 font-semibold hover:text-orange-700">
                            Xem tất cả →
                        </a>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedCars as $item)
                            @php
                                $relatedPath = $item->images->first()?->image_url ?? $item->thumbnail;
                                $relatedUrl = $resolveImage($relatedPath) ?? 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&h=450&fit=crop';
                            @endphp
                            <div class="product-card bg-gray-50 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                                <a href="{{ route('cars.show', $item->slug) }}" class="block relative overflow-hidden">
                                    <img src="{{ $relatedUrl }}" alt="{{ $item->title }}"
                                         class="w-full h-64 object-contain group-hover:scale-110 transition duration-500">
                                    @if($item->status === 'coming_soon')
                                        <div class="absolute top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold">
                                            Sắp Ra Mắt
                                        </div>
                                    @elseif($item->status === 'sold')
                                        <div class="absolute top-4 right-4 bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-bold">
                                            Đã Bán
                                        </div>
                                    @endif
                                </a>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm text-orange-600 font-semibold">
                                            {{ $item->brand->name ?? 'Không xác định' }}
                                        </span>
                                        @if($item->year)
                                            <span class="text-sm text-gray-500">{{ $item->year }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                        <a href="{{ route('cars.show', $item->slug) }}" class="hover:text-orange-600 transition">{{ $item->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        {{ $item->description ? Str::limit($item->description, 100) : 'Mẫu xe chất lượng cao, hiệu suất ổn định, phù hợp nhiều nhu cầu vận tải.' }}
                                    </p>

                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="bg-white rounded-lg p-3">
                                            <p class="text-xs text-gray-500">Động cơ</p>
                                            <p class="font-bold text-gray-800">
                                                {{ $item->engine ?? 'Đang cập nhật' }}
                                            </p>
                                        </div>
                                        <div class="bg-white rounded-lg p-3">
                                            <p class="text-xs text-gray-500">Số chỗ</p>
                                            <p class="font-bold text-gray-800">
                                                {{ $item->seats ? $item->seats . ' chỗ' : 'Đang cập nhật' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Giá từ</p>
                                            <p class="text-2xl font-bold text-orange-600">
                                                {{ $item->formatted_price }}
                                            </p>
                                        </div>
                                        <a href="{{ route('cars.show', $item->slug) }}"
                                           class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                                            Chi Tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper === 'undefined') {
                console.error('Swiper library not loaded');
                return;
            }

            let thumbsSwiper = null;
            const thumbsEl = document.querySelector('.car-thumbs-swiper');
            if (thumbsEl) {
                thumbsSwiper = new Swiper(thumbsEl, {
                    spaceBetween: 12,
                    slidesPerView: 'auto',
                    freeMode: true,
                    watchSlidesProgress: true,
                });
            }

            const mainEl = document.querySelector('.car-main-swiper');
            if (mainEl) {
                new Swiper(mainEl, {
                    spaceBetween: 10,
                    loop: true,
                    navigation: {
                        nextEl: mainEl.querySelector('.swiper-button-next'),
                        prevEl: mainEl.querySelector('.swiper-button-prev'),
                    },
                    pagination: {
                        el: mainEl.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    thumbs: thumbsSwiper ? { swiper: thumbsSwiper } : undefined,
                });
            }

            // Fancybox lightbox
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="car-gallery"]', {
                    animated: true,
                    showClass: 'f-fadeIn',
                    hideClass: 'f-fadeOut',
                    Toolbar: {
                        display: {
                            left: ['infobar'],
                            middle: [],
                            right: ['slideshow', 'fullscreen', 'download', 'thumbs', 'close'],
                        },
                    },
                    Thumbs: {
                        type: 'classic',
                    },
                    Carousel: {
                        transition: 'slide',
                    },
                });
            }
        });
    </script>
@endsection
