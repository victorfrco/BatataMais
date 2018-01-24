<?php

namespace App\Http\Controllers;

use App\Forms\providerForm;
use App\Models\provider;
use function compact;
use Illuminate\Http\Request;
use function route;
use function view;

class providerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = provider::orderBy('name', 'asc')->paginate(6);
        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(providerForm::class, [
            'url' => route('admin.providers.store'),
            'method' => 'POST'
        ]);

        return view('admin.providers.create', compact('form'));
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
        $form = \FormBuilder::create(providerForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        provider::create($data);

        $request->session()->flash('message', 'Fornecedor cadastrado com sucesso!');
        return redirect()->route('admin.providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(provider $provider)
    {
        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(provider $provider)
    {
        $form = \FormBuilder::create(providerForm::class,[
            'url' => route('admin.providers.update', ['provider' => $provider->id]),
            'method' => 'PUT',
            'model' => $provider
        ]);

        return view('admin.providers.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(provider $provider)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(providerForm::class,
            ['data' => ['id' => $provider->id]
            ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }


        $data = $form->getFieldValues();
        $provider->update($data);

        session()->flash('message', 'Fornecedor alterado com sucesso!');
        return redirect()->route('admin.providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(provider $provider)
    {
        $provider->delete();
        session()->flash('message', 'Fornecedor excluído com sucesso!');
        return redirect()->route('admin.providers.index');
    }
}
