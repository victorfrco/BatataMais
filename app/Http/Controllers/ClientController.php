<?php

namespace App\Http\Controllers;

use App\Forms\ClientForm;
use App\Models\Client;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(ClientForm::class, [
            'url' => route('admin.clients.store'),
            'method' => 'POST'
        ]);

        return view('admin.clients.create', compact('form'));
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
        $form = \FormBuilder::create(ClientForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $data['associated'] = $data['associated'] == null ? 0 : 1;

        Client::create($data);

        $request->session()->flash('message', 'Cliente criado com sucesso!');
        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $form = \FormBuilder::create(ClientForm::class,[
            'url' => route('admin.clients.update', ['client' => $client->id]),
            'method' => 'PUT',
            'model' => $client
        ]);

        return view('admin.clients.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Client $client)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(ClientForm::class,
            ['data' => ['id' => $client->id]
            ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $data['associated'] = $data['associated'] == null ? 0 : 1;
        $client->update($data);

        session()->flash('message', 'Cliente alterado com sucesso!');
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        session()->flash('message', 'Cliente excluído com sucesso!');
        return redirect()->route('admin.clients.index');
    }
}
