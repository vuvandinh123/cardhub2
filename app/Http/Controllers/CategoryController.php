<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $query = Category::withCount('cars')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->get();

        return view('pages.categories.index', [
            'categories' => $categories,
            'pageTitle' => 'Danh Mục Xe'
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show($slug)
    {
        // Tìm category theo slug
        $category = $this->categoryRepository->all()->where('slug', $slug)->first();
        
        if (!$category) {
            abort(404);
        }

        return view('pages.categories.show', [
            'category' => $category
        ]);
    }
}
