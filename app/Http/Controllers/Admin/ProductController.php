<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Product::orderBy('id', 'desc')->get();
            return datatables::of($data)
                ->addColumn('image', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->image ?? 'uploads/images/no-image.jpg').'" width="70px;" class="rounded-circle" />';
                })->addColumn('seller', function($data) {
                    return $data->seller->name ?? '';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('admin.products.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.products.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['image','seller','action'])
                ->make(true);
        }else{
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.admin.product.index', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = User::where('type', 'Seller')->get();
        return view('backend.admin.product.create', compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'price'     => 'required|numeric',
            'quantity'  => 'required|numeric',
            'image'     => 'nullable|image',
            'seller'     => 'required|exists:users,id',
        ]);

        $product = new Product();
        $product->name      =   $request->name;
        $product->price     =   $request->price;
        $product->quantity  =   $request->quantity;
        $product->seller_id  =   $request->seller;
        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $product->image = $folder_path.$image_new_name;
        }
        try {
            $product->save();
            return back()->withToastSuccess('Successfully saved');
        }catch(\Exception $exception){
            return back()->withErrors($exception->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $sellers = User::where('type', 'Seller')->get();
        return view('backend.admin.product.edit', compact('product', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'      => 'required|string',
            'price'     => 'required|numeric',
            'quantity'  => 'required|numeric',
            'image'     => 'nullable|image',
            'seller'     => 'required|exists:users,id',
        ]);

        $product->name      =   $request->name;
        $product->price     =   $request->price;
        $product->quantity  =   $request->quantity;
        $product->seller_id  =   $request->seller;
        if($request->hasFile('image')){
            if ($product->image != null)
                File::delete(public_path($product->image));
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $product->image = $folder_path.$image_new_name;
        }
        try {
            $product->save();
            return back()->withToastSuccess('Successfully updated');
        }catch(\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image != null)
                File::delete(public_path($product->image)); //Old image delete
            $product->delete();
            return response()->json([
                'type' => 'success',
                'message' => ''
            ]);
        }catch (\Exception$exception){
            return response()->json([
                'type' => 'error',
                'message' => ''
            ]);
        }
    }
}
