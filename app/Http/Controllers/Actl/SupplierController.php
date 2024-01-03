<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    //
    public function SupplierAll()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('suppliers'));
    }
    public function SupplierAdd()
    {
        $postalCodes = PostalCode::latest()->get();
        return view('backend.supplier.supplier_add', compact('postalCodes'));
    }
    public function SupplierStore(Request $request)
    {

        Supplier::insert([
            "code" => $request->code,
            "name" => $request->name,
            "address1" => $request->address1,
            "address2" => $request->address2,
            "town" => $request->town,
            "postalCode" => $request->postalCode,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Postal Code Inserted',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.all')->with($notification);
    }
    public function SupplierEdit($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            return view('backend.supplier.supplier_edit', compact('supplier'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('supplier.all')->with($notification);
    }
    public function SupplierUpdate(Request $request)
    {
        try {
            $supplier = Supplier::find($request->id);
            $supplier->code = $request->code;
            $supplier->name = $request->name;
            $supplier->address1 = $request->address1;
            $supplier->address2 = $request->address2;
            $supplier->town = $request->town;
            $supplier->postalCode = $request->postalCode;
            $supplier->save();
            $notification = array(
                'message' => 'Supplier Updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierDelete($id)
    {
        try {
            Supplier::destroy($id);
            $notification = array(
                'message' => 'Supplier deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('supplier.all')->with($notification);
    }
}
