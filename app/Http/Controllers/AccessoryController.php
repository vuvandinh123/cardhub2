<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\AccessoryCategory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function categories(Request $request)
    {
        $query = AccessoryCategory::query()
            ->withCount('accessories')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->string('search') . '%');
        }

        $categories = $query->get();

        return view('pages.accessories.categories', [
            'categories' => $categories,
        ]);
    }

    public function index(Request $request)
    {
        $query = Accessory::query()
            ->with(['category', 'car', 'primaryImage'])
            ->where('is_active', true)
            ->orderByDesc('id');

        if ($request->filled('search')) {
            $search = (string) $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $categorySlug = (string) $request->string('category');
            $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }

        $sortBy = (string) $request->input('sort_by', 'newest');
        match ($sortBy) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            default => $query->orderByDesc('id'),
        };

        $accessories = $query->paginate(12)->withQueryString();

        $categories = AccessoryCategory::query()
            ->withCount('accessories')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.accessories.index', [
            'accessories' => $accessories,
            'categories' => $categories,
            'selectedCategory' => $request->input('category'),
            'sortBy' => $sortBy,
        ]);
    }

    public function show(Accessory $accessory)
    {
        if (!$accessory->is_active) {
            abort(404);
        }

        $accessory->load([
            'category',
            'car',
            'images',
            'primaryImage',
        ]);

        $relatedAccessories = Accessory::query()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true)
            ->where('id', '!=', $accessory->id)
            ->where('accessory_category_id', $accessory->accessory_category_id)
            ->latest('id')
            ->take(4)
            ->get();

        if ($relatedAccessories->isEmpty()) {
            $relatedAccessories = Accessory::query()
                ->with(['category', 'primaryImage'])
                ->where('is_active', true)
                ->where('id', '!=', $accessory->id)
                ->latest('id')
                ->take(4)
                ->get();
        }

        return view('pages.accessories.show', [
            'accessory' => $accessory,
            'relatedAccessories' => $relatedAccessories,
        ]);
    }
}

