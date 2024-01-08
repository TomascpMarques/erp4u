<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parteleira;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Throwable;

class ParteleiraController extends Controller
{
    public function ParteleiraAll()
    {
        $parteleiras = Parteleira::latest()->get();
        return view('backend.parteleira.parteleira_all', compact('parteleiras'));
    }
    public function ParteleiraAdd()
    {
        return view('backend.parteleira.parteleira_add');
    }
    public function ParteleiraStore(Request $request)
    {
        try {
            Parteleira::insert([
                "code" => $request->codParteleira,
                "corredor" => $request->corredor,
                "maxItems" => $request->maxItems,
                "currentItems" => $request->items,
                "created_by" => Auth::user()->id,
                "created_at" => Carbon::now(),
                "updated_by" => Auth::user()->id,
            ]);
            $notification = array(
                'message' => 'Parteleira Inserted',
                'alert-type' => 'success',
            );
            return redirect()->route('parteleira.all')->with($notification);
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            return redirect()->route('parteleira.all')->with($notification);
        }

    }
    public function ParteleiraEdit($id)
    {
        try {
            
            $parteleiras = Parteleira::findOrFail($id);
            return view('backend.parteleira.parteleira_edit', compact('parteleiras'));
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            return redirect()->route('partleira.all')->with($notification);
        }
    }
    public function ParteleiraUpdate(Request $request)
    {
        try {
            $parteleira = Parteleira::find($request->id);
            $parteleira->code = $request->code;
            $parteleira->corredor = $request->corredor;
            $parteleira->maxItems = $request->maxItems;
            $parteleira->currentItems = $request->currentItems;
            $parteleira->save();
            $notification = array(
                'message' => 'Parteleira Updated',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('parteleira.all')->with($notification);
    }

    public function ParteleiraDelete($id)
    {
        try {
            Parteleira::destroy($id);
            $notification = array(
                'message' => 'Parteleira deleted',
                'alert-type' => 'success',
            );
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('parteleira.all')->with($notification);
    }
}
