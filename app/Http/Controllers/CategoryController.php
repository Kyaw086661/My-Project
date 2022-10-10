<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category  list
    public function list(){
        $categories = Category::when(request('searchKey'),function($query){
            $query -> where('name','like','%'. request('searchKey').'%');
        })->orderBy('id','desc')->paginate(5);
        $categories->appends(request()->all());
        // dd($categories->toArray());
        return view ('admin.category.list',compact('categories'));
    }
    //direct category create page
    public function createPage(){
        return view ('admin.category.create');
    }
    //direct category data create
    public function create(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this-> requestCategoryData($request);
        Category::create($data);
        return redirect (route('category#list'));
    }

    //category delete
    public function delete($id){
        // dd($id);
        Category::where('id',$id)->delete();
        return redirect(route('category#list'))->with(['deleteSuccess'=>'Delete Success']);
    }
    // direct edit page
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    //update page
    public function update(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);//redirect()->route('category#list)
        return redirect()->route('category#list');
    }

    // category valitdation  check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required |min:4 | unique:categories,name,'.$request->categoryId
        ])->validate();
    }
    // request category data
    private function requestCategoryData($request){
        return[
            'name' => $request->categoryName
        ];
    }

}
