<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['user_id'] = Auth::id();
        Category::create($validated);

        return redirect()->route('categories.index')->with('status', 'Categorie aangemaakt.');
    }

    public function edit(Category $category)
    {
        $this->authorizeCategory($category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorizeCategory($category);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')->with('status', 'Categorie bijgewerkt.');
    }

    public function destroy(Category $category)
    {
        $this->authorizeCategory($category);
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Categorie verwijderd.');
    }

    protected function authorizeCategory(Category $category): void
    {
        abort_if($category->user_id !== Auth::id(), 403);
    }
}
