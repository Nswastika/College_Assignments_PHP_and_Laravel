<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()->role; //created to get role

        $book = Product::where('type', 'book')->get();
        $cd = Product::where('type', 'cd')->get();

        if($role == "admin"){
            return view('mainAdmin/products',['book'=>$book, 'cd'=>$cd]);     
        }

        if($role == "cdAdmin"){
            return view('cdAdmin/products',['cd'=>$cd]);
        }  
        
        if($role == "bookAdmin"){
            return view('bookAdmin/products',['book'=>$book]);
        }  
        if($role == "customer"){
            return view('customer/products',['book'=>$book, 'cd'=>$cd]);  
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = auth()->user()->role; //created to get a role

        if($role == "admin"){
            return view('mainAdmin/createProduct');    
        }

        if($role == "cdAdmin"){
            return view('cdAdmin/createProduct');
        }
        if($role == "bookAdmin"){
            return view('bookAdmin/createProduct');
        }  

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create(request()->validate([
            'title' => 'required',
            'type' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'price' => 'required',
            'papl' => 'required'
        ]));

        $role = auth()->user()->role; 

        if($role == "admin"){
            return redirect('/products');   
        }

        if($role == "cdAdmin"){
            return redirect('/cdproducts');
        }
        if($role == "bookAdmin"){
            return redirect('/bookproducts');
        }  

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        $role = auth()->user()->role; 

        $book = Product::where('type', 'book')->get();
        $cd = Product::where('type', 'cd')->get();

        if($role == "admin"){

            if($product->type == 'book') 
            return view('mainAdmin/bookProduct', ['product'=>$product]);
    
            if($product->type=='cd') 
            return view('mainAdmin/cdProduct', ['product'=>$product]);   
        }

        if($role == "cdAdmin"){
            if($product->type=='cd') 
            return view('cdAdmin/cdProduct', ['product'=>$product]);  
        }  
        
        if($role == "bookAdmin"){
            if($product->type == 'book') 
            return view('mainAdmin/bookProduct', ['product'=>$product]);  
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {


        $role = auth()->user()->role; 

        if($role == "admin"){
            if($product->type == 'book') 
            return view('mainAdmin/editBookProduct', ['product'=>$product]);
    
            if($product->type=='cd') 
            return view('mainAdmin/editCdProduct', ['product'=>$product]);
        }

        if($role == "cdAdmin"){
    
          if($product->type=='cd') 
          return view('cdAdmin/editCdProduct', ['product'=>$product]);
        }  
        if($role == "bookAdmin"){
    
            if($product->type=='book') 
            return view('bookAdmin/editBookProduct', ['product'=>$product]);
          }  
        
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Product $product)
    {
        $role = auth()->user()->role;
        $product->update(request()->validate([
            'title' => 'required',
            'type' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'price' => 'required',
            'papl' => 'required'
        ]));
        if($role == "admin"){
            return redirect('/products');   
        }

        if($role == "cdAdmin"){
            return redirect('/cdproducts');
        }
        if($role == "bookAdmin"){
            return redirect('/bookproducts');
        }  


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {    $role = auth()->user()->role;
         $product->delete();     
         if($role == "admin"){
            return redirect('/products');   
        }

        if($role == "cdAdmin"){
            return redirect('/cdproducts');
        }
        if($role == "bookAdmin"){
            return redirect('/bookproducts');
        }   
    }
}
