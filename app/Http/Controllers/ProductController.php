<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
        //
        $products=Product::orderBy('name')->get();

        return view('product.index',compact('products'));
    }


    public function create()
    {
        //
        $categories=$this->getAllCategories();

        return view('product.create',compact('categories'));
    }


    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'model' => 'required|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',

        ]);
        $product=Product::create($request->all());

        $cateory_ids=explode(",",$request->real_cat);
        $product->categories()->sync($cateory_ids);

        return redirect('/products')->with('success','Product is successfully saved!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Product::find($id);//->with('categories')->first();
        $categories=$this->getAllCategories();
        // $category = $product->categories;//->orderBy('full_name')->get();
        // dd(compact($product));
        $my_cats=$product->categories;
        foreach ($my_cats as $my_cat) {
            foreach ($categories as $cat) {
                if($my_cat->id==$cat->id){
                    $my_cat['full_name']=$cat['full_name'];
                    break;
                }
            }
        }
        return view('product.edit', compact('product','categories','my_cats'));
    }


    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'model' => 'required|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        Product::whereId($id)->update($validatedData);

        $cateory_ids=explode(",",$request->real_cat);

        $product=Product::find($id);

        $product->categories()->sync($cateory_ids);

        return redirect('/products')->with('success', 'Product is successfully updated');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product is successfully deleted');
    }

    public function getAllCategories(){

        $all_cat=[];
        $root_cat=Category::where('parent_id','=',0)->get();

        foreach ($root_cat as $cat) {
            $cat['full_name']=$cat['name'];
            array_push($all_cat, $cat);
        }  
        //dd($root_cat);  
        while(1){
            $new_children=[];
            foreach ($root_cat as $cat) {
                $child_cat=$cat->children;
                if(count($child_cat)>0){
                    foreach ($child_cat as $cat_c) {
                        $cat_c['full_name']=$cat['full_name'] . " > " . $cat_c['name'];
                        array_push($new_children, $cat_c);
                        array_push($all_cat, $cat_c);
                    }
                }
            }
            if(count($new_children)>0){
                $root_cat=$new_children;
            }else{
                break;
            }    
        }

        return $all_cat;
    }
}
