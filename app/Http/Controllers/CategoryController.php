<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->back();
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
