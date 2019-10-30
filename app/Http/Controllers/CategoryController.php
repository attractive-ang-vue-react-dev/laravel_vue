<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        //
        // $categories=Category::orderBy('full_name')->get();
        $categories=$this->getAllCategories();

        return view('category.index',compact('categories'));
    }


    public function create()
    {
        //
        $categories=$this->getAllCategories();

        return view('category.create',compact('categories'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'parent_id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);
        
        // if ($request->parent_id>0) {
        //     $category=Category::where('id','=',$request->parent_id)->first();
        //     $full_name=$category->full_name . ' > ' . $request->name;
        // }else{
        //     $full_name=$request->name;
        // }
        $category_data=array(
            'parent_id' => $request->parent_id,
            'name' => $request->name
        );
        
        $category=Category::create($category_data);

        return redirect('/categories')->with('success','Category is successfully saved!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories=$this->getAllCategories();
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category','categories'));
    }


    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'product_id' => '',
            'name' => 'required|max:255',
        ]);
        
        // if ($request->parent_id>0) {
        //     $category=Category::where('id','=',$request->parent_id)->first();
        //     $full_name=$category->full_name . ' > ' . $request->name;
        // }else{
        //     $full_name=$request->name;
        // }
        $category_data=array(
            'parent_id' => $request->parent_id,
            'name' => $request->name
        );

        Category::whereId($id)->update($category_data);

        return redirect('/categories')->with('success', 'Category is successfully updated');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Category is successfully deleted');
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
