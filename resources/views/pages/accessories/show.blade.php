@extends('layouts.app')

@section('title', ($accessory->meta_title ?? $accessory->name) . ' | KIMAN')

@section('meta')
    @include('partials.meta-tag', [
        'title' => ($accessory->meta_title ?? $accessory->name) . ' | KIMAN',
        'meta_description' => $accessory->meta_description ?? $accessory->description ?? '',
        'meta_keywords' => $accessory->meta_keywords ?? '',
        'meta_image' => $accessory->thumbnail ? asset('storage/' . $accessory->thumbnail) : asset('images/logo.png'),
    ])
@endsection

@section('content')
    @php
        $resolveImage = function ($path) {
            if (!$path) return null;
            if (preg_match('~^https?://~', $path)) return $path;
            return asset('storage/' . ltrim($path, '/'));
        };

        $gallery = collect([$accessory->primaryImage?->image_url, $accessory->thumbnail])
            ->merge($accessory->images->pluck('image_url'))
            ->filter()
            ->map(fn($path) => $resolveImage($path))
            ->filter()
            ->unique()
            ->values();

        $mainImage = $gallery->first() ?? 'https://images.unsplash.com/photo-1580274455191-1c62238fa333?w=1000&h=700&fit=crop';
    @endphp

    @include('partials.header')

    <section class="mt-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container max-w-7xl mx-auto px-4 py-10">
            <nav class="text-xs md:text-sm text-gray-300 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
                <span class="mx-2 text-gray-500">/</span>
                <a href="{{ route('accessories.index') }}" class="hover:text-white">Phụ kiện</a>
                <span class="mx-2 text-gray-500">/</span>
                <span class="text-gray-200">{{ $accessory->name }}</span>
            </nav>
            <p class="text-orange-300 text-xs font-semibold mb-2">{{ $accessory->category->name ?? 'Phụ kiện' }}</p>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">{{ $accessory->name }}</h1>
        </div>
    </section>

    <section class="py-10 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4 grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                    <img id="accessoryMainImage" src="{{ $mainImage }}" alt="{{ $accessory->name }}" class="w-full h-[320px] md:h-[480px] object-cover">
                    @if($gallery->count() > 1)
                        <div class="p-4 border-t bg-gray-50">
                            <div class="flex gap-3 overflow-x-auto">
                                @foreach($gallery as $image)
                                    <button type="button" data-gallery-thumb="{{ $image }}" class="w-20 h-16 shrink-0 rounded-xl overflow-hidden border hover:border-orange-500">
                                        <img src="{{ $image }}" alt="{{ $accessory->name }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Chi tiết phụ kiện</h2>
                    @if($accessory->content)
                        <div class="prose max-w-none">{!! $accessory->content !!}</div>
                    @else
                        <p class="text-gray-700">{{ $accessory->description ?: 'Hiện chưa có nội dung chi tiết cho phụ kiện này.' }}</p>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-28 space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <p class="text-sm text-gray-500">Giá tham khảo</p>
                        <p class="text-3xl font-extrabold text-orange-600 mt-1">
                            {{ $accessory->price ? number_format($accessory->price, 0, ',', '.') . ' ₫' : 'Liên hệ' }}
                        </p>
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-gray-50 rounded-2xl p-4"><p class="text-xs text-gray-500">SKU</p><p class="font-bold text-gray-800">{{ $accessory->sku ?: '—' }}</p></div>
                            <div class="bg-gray-50 rounded-2xl p-4"><p class="text-xs text-gray-500">Số lượng</p><p class="font-bold text-gray-800">{{ $accessory->quantity ?? 0 }}</p></div>
                        </div>
                        <div class="mt-6 flex flex-col gap-3">
                            <a href="{{ route('contact') }}" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-xl font-semibold text-center">Nhận tư vấn phụ kiện</a>
                            <a href="{{ route('accessories.index') }}" class="w-full border border-gray-200 text-gray-800 py-3 rounded-xl font-semibold text-center">Xem thêm phụ kiện</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('accessoryMainImage');
            if (!mainImage) return;

            document.querySelectorAll('[data-gallery-thumb]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-gallery-thumb');
                    if (url) mainImage.src = url;
                });
            });
        });
    </script>
@endsection

