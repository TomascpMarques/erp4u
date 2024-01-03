<?php

namespace App\Http\Controllers\Actl;

use App\Models\TaxRate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TaxRatesController extends Controller
{
    public function TaxRatesAll()
    {
        $taxRates = TaxRate::latest()->get();
        return view('backend.taxRates.rates_all', compact('taxRates'));
    }

    public function TaxRatesAdd()
    {
        return view('backend.taxRates.rates_add');
    }
    public function TaxRatesStore(Request $request)
    {
        TaxRate::insert([
            'taxRateCode' => $request->taxRateCode,
            'descriptionTextRate' => $request->descriptionTextRate,
            'taxRate' => $request->taxRate,
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Tax Rate Inserted',
            'alert-type' => 'success',
        );
        return redirect()->route('taxRates.all')->with($notification);
    }
    public function TaxRatesEdit($id)
    {
        try {
            $taxRates = TaxRate::findOrFail($id);
            return view('backend.taxRates.rates_edit', compact('taxRates'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('taxRates.all')->with($notification);
    }
    public function TaxRatesUpdate(Request $request)
    {
        try {
            $product = TaxRate::find($request->id);
            $product->taxRateCode = $request->taxRateCode;
            $product->descriptionTextRate = $request->descriptionTextRate;
            $product->taxRate = $request->taxRate;
            $product->updated_at = Carbon::now();
            $product->updated_by = Auth::user()->id;
            $product->save();
            $notification = array(
                'message' => 'Tax rate updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('taxRates.all')->with($notification);
    }

    public function TaxRatesDelete($id)
    {
        try {
            TaxRate::destroy($id);
            $notification = array(
                'message' => 'Tax rate deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('taxRates.all')->with($notification);
    }
}
