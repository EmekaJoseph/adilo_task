<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoriesController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::select(['id', 'name'])->withCount('videos')->get();
        return response()->json($categories);
    }
}
