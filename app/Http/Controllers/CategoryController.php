<?php

namespace App\Http\Controllers;

use App\Forms\CategoryForm;
use App\Models\Category;
use function compact;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use function redirect;
use function route;
use function view;
use function virtual;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(6);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.store'),
            'method' => 'POST'
        ]);

        return view('admin.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(CategoryForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        Category::create($data);
        $request->session()->flash('message', 'Categoria cadastrada com sucesso!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $form = \FormBuilder::create(CategoryForm::class,[
            'url' => route('admin.categories.update', ['category' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);

        return view('admin.categories.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(CategoryForm::class,
            ['data' => ['id' => $category->id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $category->update($data);

        session()->flash('message', 'Categoria cadastrada com sucesso!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message', 'Categoria excluída com sucesso!');
        return redirect()->route('admin.categories.index');
    }
}
