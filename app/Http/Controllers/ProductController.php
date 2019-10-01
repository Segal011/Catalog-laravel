<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;
use View;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Config;
use App\ Summernote;


class ProductController extends Controller
{

    protected $products,  $reviews;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Product $products, Review $reviews)
    {
        $this->products = $products;
        $this->reviews = $reviews;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->products->all();
        foreach ($products as $product){
            $product->price = $product->base_price 
            + $product->base_price*config('services.catalog.tax_rate')/100;
            $product->special_price = $product->price 
            - $product->discount
            - $product->price*config('services.catalog.discount_p')/100
            - config('services.catalog.discount');
        }
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = array(
            'name'       => 'required',
            'sku'      => 'required',
            'base_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        
        $this->uploadImage($request);

        $request->request->add(['status' =>$request->enable? 1 : 0]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $this->products->create($request->all());
            Session::flash('message', 'Successfully created product!');
            return Redirect::to('products');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
         // get the product
         $product = $this->products->find($product->id);

         // show the view and pass the product to it
         return \View::make('product.show')
             ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
         // get the product
         $product = $this->products->find($id);

         // show the edit form and pass the product
         return View::make('product.edit')
             ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
      
        $rules = array(
            'name'       => 'required',
            'sku'      => 'required',
            'base_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        $this->uploadImage($request);
        $request->request->add(['status' =>$request->enable? 1 : 0]);
        

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $product->update($request->all());
            Session::flash('message', 'Successfully updated product!');
            return Redirect::to('products');
        }
    }

    private function uploadImage(Request $request){
        $profilefile;
        if ($files = $request->file('file')) {
            $destinationPath = 'public/file/'; // upload path
            $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profilefile);
            $insert['file'] = "$profilefile";
            $request->request->add(['image' =>$profilefile]);
         }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $producta
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->products->find($id)->delete();
        Session::flash('message', 'Successfully deleted the product!');
        return Redirect::to('products');
    }

    public function destroyAll(Request $request)
    {
         $list = $request->input('list');

         print_r($list);

        if(empty($list)){
            Session::flash('message', 'Select products to remove!');
            return Redirect::back();
        }
        foreach ($list as $id){
            $product = $this->products->find($id);
            $file = 'public/file/' . $product->image;
            Storage::delete($file);
            $this->reviews->where('product_id',$id)->delete();
            $product->delete();
        }

        Session::flash('message', 'Products Deleted successfully!');
        return Redirect::back();

    }
    

      /**
     * Rate the specific priduct.
     *
     * @param  \App\Product  $producta
     * @return \Illuminate\Http\Response
     */
    public function rate(int $id, int $rate)
    {
        $product = $this->products->find($id);
        $stars = ($product->stars * $product->stars_count + $rate)/($product->stars_count+1);

        $product->stars =  $stars; 
        $product->stars_count = $product->stars_count+1;
        $product->save();

        return Redirect::back();
    }
}
