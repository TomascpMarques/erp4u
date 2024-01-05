<?php

namespace App\Http\Controllers\Actl;

use Illuminate\Database\QueryException;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;

use Image;

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
        $imageFile = $request->file('profile_image');
        //DD($imageFile);
        $transformName = hexdec(uniqid()) . "." . $imageFile->getClientOriginalExtension();
        //console.log($transformName);
        Image::make($imageFile)->resize(200, 200)->save('upload/product/' . $transformName);
        $save_url = 'upload/product/' . $transformName;

        try {
            Product::insert([
                "code" => $request->code,
                "description" => $request->description,
                "image" => $save_url,
                "family" => $request->product_family,
                "unit" => $request->product_unit,
                "taxRateCode" => $request->product_taxRateCode,
                "created_by" => Auth::user()->id,
                "created_at" => Carbon::now(),
                "updated_by" => Auth::user()->id,
            ]);
            $notification = array(
                'message' => 'Product Inserted',
                'alert-type' => 'success',
            );
            return redirect()->route('product.all')->with($notification);
        } catch (\QueryException $e) {
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
            return view('backend.product.products_edit', compact('families', 'unitMeasures', 'taxRates', 'product'));
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            return redirect()->route('product.all')->with($notification);
        }
    }
    public function ProductsUpdate(Request $request)
    {
        if ($request->image != null) {
            $imageFile = $request->file('image');
            $transformName = hexdec(uniqid()) . "." . $imageFile->getClientOriginalExtension();
            //console.log($transformName);
            Image::make($imageFile)->resize(200, 200)->save('upload/product/' . $transformName);
            $save_url = 'upload/product/' . $transformName;
        }

        try {
            $product = Product::find($request->id);
            $product->code = $request->code;
            $product->description = $request->description;
            if ($request->image != null) {
                $product->image = $save_url;
            }
            $product->family = $request->product_family;
            $product->unit = $request->product_unit;
            $product->taxRateCode = $request->product_taxRateCode;
            $product->updated_at = Carbon::now();
            $product->updated_by = Auth::user()->id;
            $product->save();
            $notification = array(
                'message' => 'Product Updated',
                'alert-type' => 'success',
            );
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            if ($request->image != null) {
                unlink($save_url);
            }
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
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('product.all')->with($notification);
    }
}
