<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    // product list page
    public function listPage(){
        $pizzaData = Product:: select('products.*','categories.name as category_name')
        ->when(request('searchKey'),function($query){
            $query->where('products.name','like','%'.request('searchKey').'%');
        })
        ->leftjoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(5);
        // dd($pizzaData->toArray());
        $pizzaData->appends(request()->all());
        return view ('admin.products.pizzaList',compact('pizzaData'));
    }
    //product cerate page
    public function createPage(){
        $categories = Category::select('id','name')->get();// category list ထဲက item name and id ယူ
        // dd($categories->toArray());
        return view ('admin.products.create',compact('categories'));// name and id ကို compact နဲ့ create page ကို ပို့ပေး
    }
    // pizza product directly create
    public function create(Request $request ){
        // dd($request->all());
        $this->productsValidationCheck($request,"create");
        $data = $this->requestProductsInfo($request);
       $imageFileName= uniqid(). $request->file('pizzaImage')->getClientOriginalName();
        // dd($imageFileName);
        $request->file('pizzaImage')->storeAs('public',$imageFileName);
        $data['image'] = $imageFileName;

        Product::create($data);
        return redirect()->route('products#listPage');

    }
    //delet pizza product
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect(route('products#listPage'))->with(['deleteSuccess'=>'product delete success..']);
    }
    // edit pizza product
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.edit',compact('pizza'));
    }
    // products update page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.update',compact('pizza','category'));
    }
    // update pizza product
    public function update(Request $request){
        $this->productsValidationCheck($request,"update");
        $data = $this->requestProductsInfo($request);
        // dd($data);
        if($request->hasFile('pizzaImage')){
        $oldImageName = Product::where('id',$request->pizzaId)->first();
        $oldImageName = $oldImageName->image;
    //    dd( $oldImageName);


        if($oldImageName != null){
            Storage::delete('public/'.$oldImageName);
        }
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
        //  dd($data);
    }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect(route('products#listPage'));
    }
    // request procucts information
    private function requestProductsInfo($request){
        return[
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,

        ];
    }
    // products validation check
    private function productsValidationCheck($request, $action){
        $validationRule = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',

            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',

        ];
        $validationRule['pizzaImage'] = $action== "create" ? 'required|mimes:jpg,jpeg,webp, png|file': 'mimes:jpg,jpeg,webp, png|file';
        // dd($validationRule);
        Validator::make($request->all(), $validationRule,[])->validate();
    }
}
