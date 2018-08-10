<?php

namespace App\Http\Controllers;

use App\Forms\BrandForm;
use App\Models\Brand;
use function base64_encode;
use function compact;
use DB;
use function dd;
use const DIRECTORY_SEPARATOR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use function preg_replace_array;
use function redirect;
use function route;
use function storage_path;
use function str_after;
use function str_contains;
use function str_split;
use function strlen;
use function strtolower;
use function strtoupper;
use function utf8_encode;
use function var_dump;
use function view;
use function xdebug_var_dump;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->paginate(6);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(BrandForm::class, [
            'url' => route('admin.brands.store'),
            'method' => 'POST'
        ]);

        return view('admin.brands.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if($request->logo) {
    		//retorna o valor inteiro do ultimo ID registrado no banco
    		$id = DB::select('SELECT MAX(id) as id from brands')[0]->id;
    		//incrementa um representando o proximo ID a ser inserido no banco
		    $id++;
    		$photoName = 'brand'.$id.'.' . $request->logo->getClientOriginalExtension();
		    $request->logo->move( storage_path( 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'brands' ), $photoName );
    	}
	    /**@var Form $form*/
        $form = \FormBuilder::create(BrandForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        if($request->logo)
            $data['logo_path'] = 'storage/images/brands/'.$photoName;
        $data['status'] = $data['status'] == null ? 0 : 1;
        Brand::create($data);

        $request->session()->flash('message', 'Marca cadastrada com sucesso!');
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $form = \FormBuilder::create(BrandForm::class,[
            'url' => route('admin.brands.update', ['brand' => $brand->id]),
            'method' => 'PUT',
            'model' => $brand
        ]);

        return view('admin.brands.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Brand $brand)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(BrandForm::class,
            ['data' => ['id' => $brand->id]
            ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
	    if($data['logo'] != null) {
//	        dd($data['logo']);
            if($brand->logo_path == null){
                $photoName = 'brand'.$brand->id.'.' . $data['logo']->getClientOriginalExtension();
                $data['logo']->move( storage_path( 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'brands' ), $photoName );
                $brand->logo_path = 'storage/images/brands/'.$photoName;
            }else
			    $data['logo']->move( storage_path( 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'brands' ), $brand->logo_path );
	    }
        $data['status'] = $data['status'] == null ? 0 : 1;

        $brand->update($data);

        session()->flash('message', 'Marca alterada com sucesso!');
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        session()->flash('message', 'Marca excluída com sucesso!');
        return redirect()->route('admin.brands.index');
    }

	public function upload()
	{
		return view ('admin.sells.index');
	}

	public function moveLogo(Request $request)
	{
		$photoName = $request->get('name').'.'.$request->user_photo->getClientOriginalExtension();
		$request->user_photo->move(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'brands'), $photoName);
	}
}
