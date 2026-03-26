@extends('layouts.app')

@section('title', 'KIMAN - Đầu kéo HOWO, MAN, SHACMAN chính hãng')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'KIMAN - Đầu kéo HOWO, MAN, SHACMAN chính hãng',
        'meta_description' => 'KIMAN chuyên phân phối đầu kéo HOWO, MAN, SHACMAN chính hãng. Tư vấn tận tâm, thông số minh bạch, hỗ trợ nhanh chóng toàn quốc.',
        'meta_keywords' => 'KIMAN, đầu kéo HOWO, đầu kéo MAN, đầu kéo SHACMAN, xe đầu kéo chính hãng',
        'meta_image' => asset('images/logo.png'),
        'canonical_url' => url('/'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
    <style>
        .car-silhouette {
            background: linear-gradient(45deg, #e5e7eb 0%, #f3f4f6 100%);
            clip-path: polygon(15% 85%, 20% 75%, 25% 70%, 35% 65%, 50% 60%,
                    65% 65%, 75% 70%, 85% 75%, 90% 85%, 85% 95%,
                    15% 95%);
        }
    </style>
@endsection

@section('content')
    @include('partials.header')
    @include('pages.home._hero')
    @include('pages.home._about')
    @include('pages.home._categories')
    @include('pages.home._products')
    @include('pages.home._features')
    @include('pages.home._blog')
    @include('pages.home._contact')
    @include('partials.footer')
@endsection
@section('scripts')
    @include('pages.home._scripts')
@endsection
