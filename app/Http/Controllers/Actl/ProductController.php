<?php

namespace App\Http\Controllers\Actl;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;

class ProductController extends Controller
{
    public function ProductsAll()
    {
        $products = Product::latest()->get();
        return view('backend.product.products_all', compact('products'));
    }
    public function ProductsAdd()
    {
        $families = Family::all();
        $unitMeasures = UnitMeasure::all();
        $taxRates = TaxRate::all();
        return view('backend.product.products_add', compact('families', 'unitMeasures', 'taxRates'));
    }
    public function ProductsStore(Request $request)
    {
        $imageFile = $request->file('profileImage');
        
        $transformName = hexdec(uniqid()). "." . $imageFile->getClientOriginalExtension();

        Image::make($imageFile)->resize(200,200)->save('upload/product/'. $transformName);
        $save_url='upload/product/'. $transformName;

    try{
        Product::insert([
            "code" => $request->code,
            "description" => $request->description,
            "image" => $save_url,
            "family" => $request->family,
            "unit" => $request->unit,
            "taxRateCode" => $request->taxRateCode,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
            "updated_by" => Auth::user()->id,
        ]);
            $notification = array(
            'message' => 'Product Inserted',
            'alert-type' => 'success',
        );
        return redirect()->route('product.all')->with($notification);
    } catch (\Exception $e) {
        $notification = array(
            'message' => $e,
            'alert-type' => 'error',
        );
        unlink($save_url);
        return redirect()->route('product.all')->with($notification);
    }
        
    }
    public function ProductsEdit($id)
    {
        try {
            $families = Family::all();
            $unitMeasures = UnitMeasure::all();
            $taxRates = TaxRate::all();
            $product = Product::findOrFail($id);
            return view('backend.product.product_edit', compact('families','unitMeasures','taxRates','product'));

        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('product.all')->with($notification);
    }
    public function ProductsUpdate(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->code = $request->code;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->family = $request->family;
            $product->unit = $request->unit;
            $product->taxRateCode = $request->taxRateCode;
            $product->updated_at = Carbon::now();
            $product->updated_by = Auth::user()->id;
            $product->save();
            $notification = array(
                'message' => 'Product Updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductsDelete($id)
    {
        try {
            Product::destroy($id);
            $notification = array(
                'message' => 'Product deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('product.all')->with($notification);
    }
}
