<?php

namespace App\Http\Controllers\apis;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use App\traits\generalTrait;
use Illuminate\Http\Request;
use App\Models\ProductsImages;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use generalTrait;

    public function index()
    {
        // do query
        $products = Product::select('id','name','price','quantity','code')->orderBy('price','DESC')->get();
        // return response json
        return $this->returnData('products',$products);
    }

    public function create()
    {
        $brands = Brand::select('id','name')->get();
        $subCategories = Subcategory::select('id','name')->get();
        return $this->returnData('data',['brands'=>$brands,'subcategories'=>$subCategories]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return $this->returnData('product',$product);
    }

    public function delete($id)
    {
        // delete product from DB
        Product::find($id)->delete();
        // get all images
        $images = ProductsImages::where('product_id',$id)->get();
        // delete all images from DB
        ProductsImages::where('product_id',$id)->delete();
        //delete Photos From Server
        foreach($images AS $key=>$image){
            // sleep(3);
            $oldPath = public_path('images\products\\'.$image['image']);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }

        }
        return $this->returnSuccessMessage("Product Has been Successfully Deleted",200);

    }

    public function store(Request $request)
    {
        // return $request->all();
        // vildate
        $rules  = [
            'name'=>['required','string','max:255'],
            'code'=>['required','integer','digits:5','min:10000','max:99999','unique:products'],
            'price'=>['required','numeric','max:100000'],
            'quantity'=>['required','integer','min:1'],
            'status'=>['required','boolean'],
            'brand_id'=>['required','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'description'=>['nullable','string'],
            'image'=>['required','mimes:png,jpg,jpeg','max:1000']
        ];
        // $request->validate($rules);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }
        // upload photo
        $photoName = $this->uploadPhoto($request->image,'products');
        // insert data
        // $data = $request->except('image');
        // $data['image'] = $photoName;

        $product = new Product;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->brand_id = $request->brand_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->description = $request->description;
        $product->save();
        ProductsImages::create(['image'=>$photoName,'primary_image'=>1,'product_id'=>$product->id]);
        // return response json
        return $this->returnSuccessMessage("product has been successfully created",200);
    }

    public function update(Request $request,$id)
    {
        $rules  = [
            'name'=>['required','string','max:255'],
            'code'=>['required','integer','digits:5','min:10000','max:99999',Rule::unique('products')->ignore($id,'id')],
            'price'=>['required','numeric','max:100000'],
            'quantity'=>['required','integer','min:1'],
            'status'=>['required','boolean'],
            'brand_id'=>['required','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'description'=>['nullable','string'],
            'image'=>['nullable','mimes:png,jpg,jpeg','max:1000']
        ];
        // $request->validate($rules);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }
        // update on photo
        if($request->has('image')){
            // upload new photo to server
            $photoName = $this->uploadPhoto($request->image,'products');
            // to get old photo name
            $oldImageName = ProductsImages::select('image')->where([['product_id','=',$id],['primary_image','=',1]])->first();
            // update image in db
            ProductsImages::where([['product_id','=',$id],['primary_image','=',1]])
            ->update(['image'=>$photoName,'primary_image'=>1,'product_id'=>$id]);
            // to delete image from server
            if($oldImageName){
                $oldPath = public_path('images\products\\'.$oldImageName->image);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

        }
        // update on product
        $product = Product::find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->brand_id = $request->brand_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->description = $request->description;
        $product->save();
        return $this->returnSuccessMessage("product has been successfully updated",200);

    }

}


