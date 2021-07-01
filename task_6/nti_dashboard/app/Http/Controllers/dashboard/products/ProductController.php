<?php

namespace App\Http\Controllers\dashboard\products;

use App\traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::select('SELECT `products`.* FROM `products` ORDER BY `products`.`created_at` DESC');
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = DB::select("SELECT `brands`.* FROM `brands` ORDER BY `brands`.`name` ASC");
        $subCategories = DB::table('subcategories')->select('id','name')->orderBy('name')->get();
        return view('dashboard.products.create',compact('brands','subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return  $request->all();
        // validate
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
        $request->validate($rules);
        // upload image
        $photoName = $this->uploadPhoto($request->image,'products');
        // insert data
        $data = $request->except('_token','image','add');
        $product_id = DB::table('products')->insertGetId($data);
        DB::table('products_images')->insert(['image'=>$photoName,'product_id'=>$product_id,'primary_image'=>1]);
        // redirect on page
        if($request->add == 'add')
            return redirect()->route('products.index')->with('Success','Product Has Been Successfully Created');
        else
            return redirect()->back()->with('Success','Product Has Been Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $product = DB::select("SELECT `products`.* FROM `products` WHERE `products`.`id` = ?",[$id])[0];
        // $product = DB::table('products')->where('id','=',$id)->first();
        $product = DB::table('products')->leftJoin('products_images', 'products.id', '=', 'products_images.product_id')->select('products.*','products_images.image')->find($id);
        $brands = DB::select("SELECT `brands`.* FROM `brands` ORDER BY `brands`.`name` ASC");
        $subCategories = DB::table('subcategories')->select('id','name')->orderBy('name')->get();
        return view('dashboard.products.edit',compact('brands','subCategories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return
        // return $request->all();
         // validate
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

        $request->validate($rules);
        // upload image
        if($request->has('image')){
            $photoName = $this->uploadPhoto($request->image,'products');
            // query to get image name by product id
            DB::table('products_images')->where('product_id','=',$id)->update(['image'=>$photoName]);
            // to delete old photo
            $oldPath = public_path('images\products\\'.$request->oldPhoto);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }

        }
        // update data
        $data = $request->except('_token','image','update','_method','oldPhoto');
        DB::table('products')->where('id',$id)->update($data);
        // redirect on page
        if($request->update == 'update')
            return redirect()->route('products.index')->with('Success','Product Has Been Successfully Updated');
        else
            return redirect()->back()->with('Success','Product Has Been Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get old photo name
        $photoName = DB::table('products_images')->select('image')->where('product_id',$id)->first()->image;
        // delete product DB
        DB::table('products')->where('id', $id)->delete();
        // delete photo DB
        DB::table('products_images')->where('product_id', $id)->delete();
        // delete photo from server
        $oldPath = public_path('images\products\\'.$photoName);
        if(file_exists($oldPath)){
            unlink($oldPath);
        }
        //redirect back
        return redirect()->back()->with('Success','Product '.$id.' Has Been Successfully Deleted');
    }
}
