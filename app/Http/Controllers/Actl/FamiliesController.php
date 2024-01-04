<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Throwable;

class FamiliesController extends Controller
{
    public function FamiliesAll()
    {
        $families = Family::latest()->get();
        return view("backend.product.product_families_all", compact("families"));
    }
    public function FamilyStore(Request $request)
    {
        $x = Family::insert([
            "family" => $request->family,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
            "updated_by" => Auth::user()->id,
        ]);
        $notification = array(
            'message' => $x,
            'alert-type' => 'success',
        );
        return redirect()->route('families.all')->with($notification);
    }
    public function FamilyAdd()
    {
        return view("backend.product.product_families_add");
    }
    public function FamilyEdit($id)
    {
        try {
            $family = Family::findOrFail($id);
            return view('backend.product.product_families_edit', compact('family'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('families.all')->with($notification);
    }
    public function FamilyUpdate(Request $request)
    {
        try {
            $postal = Family::find($request->id);
            $postal->family = $request->family;
            $postal->updated_at = Carbon::now();
            $postal->updated_by = Auth::user()->id;
            $postal->save();
            $notification = array(
                'message' => 'Family Updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('families.all')->with($notification);
    }

    public function FamiliesDelete($id)
    {
        try {
            Family::destroy($id);
            $notification = array(
                'message' => 'Family deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('families.all')->with($notification);
    }
}
