<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private Product $product,
        private Category $category,
        private Store $store,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all('id', 'name');
        return view("admin.products.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = $this->store->first()->products()->create($data);
        $product->categories()->sync($request->categories);
        session()->flash('message', ['type' => 'success', 'body' => 'Sucesso ao cadastrar produto']);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->findOrFail($id);
        $categories = $this->category->all('id', 'name');
        return view('admin.products.view', compact('categories', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->product->findOrFail($id);
        $categories = $this->category->all('id', 'name');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = $this->product->findOrFail($id);
        $product->update($request->all());
        $product->categories()->sync($request->categories);
        return redirect()->route('admin.products.index')
            ->with('success', 'Sucesso ao atualizar produto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Sucesso ao remover produto');
    }
}
