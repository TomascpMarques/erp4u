<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\UnitMeasure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class UnitMeasureController extends Controller
{
    public function UnitMeasuresAll()
    {
        $unitMeasures = UnitMeasure::latest()->get();
        return view('backend.unitMeasures.unitMeasures_all', compact('unitMeasures'));
    }

    public function UnitMeasuresAdd()
    {
        return view('backend.unitMeasures.unitMeasures_add');
    }
    public function UnitMeasuresStore(Request $request)
    {
        UnitMeasure::insert([
            'unit' => $request->unit,
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Unit Inserted',
            'alert-type' => 'success',
        );
        return redirect()->route('unitMeasures.all')->with($notification);
    }
    public function UnitMeasuresEdit($id)
    {
        try {
            $unitMeasures = UnitMeasure::findOrFail($id);
            return view('backend.unitMeasures.unitMeasures_edit', compact('unitMeasures'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('unitMeasures.all')->with($notification);
    }
    public function UnitMeasuresUpdate(Request $request)
    {
        try {
            $unitMeasure = UnitMeasure::find($request->id);
            $unitMeasure->unit = $request->unit;
            $unitMeasure->updated_at = Carbon::now();
            $unitMeasure->updated_by = Auth::user()->id;
            $unitMeasure->save();
            $notification = array(
                'message' => 'Unit updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('unitMeasures.all')->with($notification);
    }

    public function UnitMeasuresDelete($id)
    {
        try {
            UnitMeasure::destroy($id);
            $notification = array(
                'message' => 'Unit deleted',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('unitMeasures.all')->with($notification);
    }
}
