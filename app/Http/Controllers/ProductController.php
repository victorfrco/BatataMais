<?php

namespace App\Http\Controllers;

use App\Forms\ProductForm;
use App\Models\Product;
use function compact;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use function route;
use function view;

class ProductController extends Controller
{

	/**
	 * Display a listing of the products and its stock.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function stock()
	{
		$products = Product::all();
		return view('admin.products.stock', compact('products'));
	}

	public function addStock(Request $request)
	{
		$product = Product::find($request->toArray()['product_id']);
		$product->qtd += $request->toArray()['product_qtd'];
		$product->save();

		$moveController = new MoveController();
		$moveController->registraEntradaIndividual($product, $request->toArray()['product_qtd'], 1);

		$success = 'Produto adicionado ao estoque!';
		return view('admin.products.stock', compact('success'));
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::orderBy('name', 'asc')->paginate(6);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(ProductForm::class, [
            'url' => route('admin.products.store'),
            'method' => 'POST'
        ]);

        return view('admin.products.create', compact('form'));
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
        $form = \FormBuilder::create(ProductForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
	    $source = array('.', ',');
	    $replace = array('', '.');
        $data['price_cost'] = str_replace($source, $replace, $data['price_cost']);
        $data['price_resale'] = str_replace($source, $replace, $data['price_resale']);
        $data['price_discount'] = str_replace($source, $replace, $data['price_discount']);
        $data['price_card'] = str_replace($source, $replace, $data['price_card']);

        Product::create($data);

        $request->session()->flash('message', 'Produto cadastrado com sucesso!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $form = \FormBuilder::create(ProductForm::class,[
            'url' => route('admin.products.update', ['product' => $product->id]),
            'method' => 'PUT',
            'model' => $product
        ]);

        return view('admin.products.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        /**@var Form $form*/
        $form = \FormBuilder::create(ProductForm::class,
            ['data' => ['id' => $product->id]
            ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }


        $data = $form->getFieldValues();
        $product->update($data);

        session()->flash('message', 'Produto alterado com sucesso!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('message', 'Produto excluído com sucesso!');
        return redirect()->route('admin.products.index');
    }

    public function search(){
	    $q = Input::get ( 'q' );
	    if($q != ""){
		    $products = Product::where ( 'name', 'LIKE', $q . '%' )->paginate (6)->setPath ( '' );
		    $pagination = $products->appends ( array (
			    'q' => Input::get ( 'q' )
		    ) );
		    if (count ( $products ) > 0)
			    return view('admin.products.index', compact('products'));
	    }
	    return view ( 'admin.products.index' )->withMessage ( 'Nenhum produto encontrado!' );
    }
}
