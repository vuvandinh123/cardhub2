<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\AccessoryCategory;
use App\Models\Car;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        return response()
            ->view('sitemaps.index', [
                'sitemaps' => [
                    route('sitemaps.static'),
                    route('sitemaps.cars'),
                    route('sitemaps.posts'),
                    route('sitemaps.categories'),
                    route('sitemaps.accessories'),
                ],
            ])
            ->header('Content-Type', 'application/xml');
    }

    public function static(): Response
    {
        $urls = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('loan.calculator'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('cars.index'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('categories.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('posts.index'), 'changefreq' => 'daily', 'priority' => '0.8'],
            ['loc' => route('accessories.categories.index'), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('accessories.index'), 'changefreq' => 'daily', 'priority' => '0.8'],
        ];

        return response()
            ->view('sitemaps.urlset', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function cars(): Response
    {
        $urls = Car::query()
            ->where('status', 'available')
            ->latest('updated_at')
            ->get()
            ->map(fn(Car $car) => [
                'loc' => route('cars.show', $car->slug),
                'lastmod' => optional($car->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ])
            ->all();

        return response()
            ->view('sitemaps.urlset', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function posts(): Response
    {
        $urls = Post::query()
            ->where('is_published', true)
            ->latest('updated_at')
            ->get()
            ->map(fn(Post $post) => [
                'loc' => route('posts.show', $post),
                'lastmod' => optional($post->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ])
            ->all();

        return response()
            ->view('sitemaps.urlset', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function categories(): Response
    {
        $carCategoryUrls = Category::query()
            ->where('is_active', true)
            ->get()
            ->map(fn(Category $category) => [
                'loc' => route('cars.index', ['category' => $category->slug]),
                'lastmod' => optional($category->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.6',
            ]);

        $accessoryCategoryUrls = AccessoryCategory::query()
            ->where('is_active', true)
            ->get()
            ->map(fn(AccessoryCategory $category) => [
                'loc' => route('accessories.index', ['category' => $category->slug]),
                'lastmod' => optional($category->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.6',
            ]);

        $urls = $carCategoryUrls->merge($accessoryCategoryUrls)->all();

        return response()
            ->view('sitemaps.urlset', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function accessories(): Response
    {
        $urls = Accessory::query()
            ->where('is_active', true)
            ->latest('updated_at')
            ->get()
            ->map(fn(Accessory $accessory) => [
                'loc' => route('accessories.show', $accessory),
                'lastmod' => optional($accessory->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ])
            ->all();

        return response()
            ->view('sitemaps.urlset', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}

