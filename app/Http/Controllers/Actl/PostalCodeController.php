<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    public function PostalCodeAll()
    {
        $postalCodes = PostalCode::latest()->get();
        return view("backend.postalCode.postalCode_all", compact("postalCodes"));
    }
    public function PostalCodeAdd()
    {
        return view("backend.postalCode.postalCode_add");
    }
    public function PostalCodeStore(Request $request)
    {
        try {
            PostalCode::insert([
                "postalCode" => $request->postalCode,
                "location" => $request->location,
                "created_by" => Auth::user()->id,
                "created_at" => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Postal Code Inserted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('postalCodes.all')->with($notification);
    }
    public function PostalCodeEdit($id)
    {
        try {
            $postalCode = PostalCode::findOrFail($id);
            return view('backend.postalCode.postalCode_edit', compact('postalCode'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('postalCodes.all')->with($notification);
    }
    public function PostalCodeUpdate(Request $request)
    {
        try {
            $postal = PostalCode::find($request->id);
            $postal->postalCode = $request->postalCode;
            $postal->location = $request->location;
            $postal->save();
            $notification = array(
                'message' => 'Postal Code Updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('postalCodes.all')->with($notification);
    }
    public function PostalCodeDelete($id)
    {
        try {
            PostalCode::destroy($id);
            $notification = array(
                'message' => 'Postal Code deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('postalCodes.all')->with($notification);
    }
}
