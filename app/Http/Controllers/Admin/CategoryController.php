<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        $categories = $query->orderBy('position')->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'position' => 'required|integer|min:0',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'icon' => $validated['icon'],
            'position' => $validated['position'],
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'position' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'icon' => $validated['icon'],
            'position' => $validated['position'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->courses()->exists()) {
            return back()->with('error', 'Cannot delete category with courses.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
