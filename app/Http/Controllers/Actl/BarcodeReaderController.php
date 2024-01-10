<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarcodeReaderController extends Controller
{
    public function BarcodeReader()
    {
        $products = Product::latest()->get();
        return view(('backend.barCode.barcode_reader'), compact('products'));
    }

}
