<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;

class CategoryController extends Controller
{
    public function __construct(
        private Category $category
    )
    {
    }

    public function index()
    {
        $categories = $this->category->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request, Store $store)
    {
        $data = $request->all();

        $store->first()->categories()->create($data);

        session()->flash('message', ['type' => 'success', 'body' => 'Sucesso ao cadastrar categoria']);

        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        $category = $this->category->findOrFail($id);
        return view('admin.categories.view', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->category->findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $category->update($request->all());

        session()->flash('message', ['type' => 'success', 'body' => 'Sucesso ao atualizar categoria']);

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);

        $category->delete();

        session()->flash('message', ['type' => 'success', 'body' => 'Sucesso ao remover categoria']);

        return redirect()->route('admin.categories.index');
    }
}
