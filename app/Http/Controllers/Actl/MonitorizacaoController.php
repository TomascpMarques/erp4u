<?php

namespace App\Http\Controllers\Actl;


use App\Models\Monitorizacao;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MonitorizacaoController extends Controller
{
    public function MonitorAll()
    {
        $monitors = Monitorizacao::all();

        return view('backend.monitorizacao.monitor_all', compact('monitors'));
    }
    public function MonitorAdd()
    {
        $products = Product::select('code', 'description')->get();
        $productIdsArray = Product::select('id', 'code')->whereNotIn('code', Monitorizacao::select('code')->get())->get();
        return view('backend.monitorizacao.monitor_add', compact('products', 'productIdsArray'));
    }
    public function MonitorStore(Request $request)
    {
        $id = Product::select("id")->where('id', '=', $request->code)->first();

        Monitorizacao::insert([
            "product_id" => $id->id,
            "code" => $request->code,
            "ativa" => $request->ativa,
            "sujeito" => $request->sujeito,
            "tema" => $request->tema,
            "regra_envio" => $request->regrasDef,
            "conteudo" => $request->conteudo,
            "updated_at" => Carbon::now(),
            "created_at" => Carbon::now(),
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Monitorização Inserted',
            'alert-type' => 'success',
        );
        return redirect()->route('monitor.all')->with($notification);
        /* try {

        } catch (\Exception $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            return redirect()->route('monitor.all')->with($notification);
        } */

    }
    public function MonitorEdit($id)
    {
        try {
            $productIdsArray = Product::select('code')->get();
            $monitor = Monitorizacao::find($id);
            // DD($monitor);
            return view('backend.monitorizacao.monitor_edit', compact('monitor', 'productIdsArray'));
        } catch (QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
            return redirect()->route('product.all')->with($notification);
        }
    }
    public function MonitorUpdate(Request $request)
    {
        try {
            $monitor = Monitorizacao::find($request->id);
            $monitor->code = $request->code;
            $monitor->ativa = $request->ativa;
            $monitor->sujeito = $request->sujeito;
            $monitor->tema = $request->tema;
            $monitor->conteudo = $request->conteudo;
            $monitor->updated_at = Carbon::now();
            $monitor->updated_by = Auth::user()->id;
            $monitor->save();

            $notification = array(
                'message' => 'Monitorizacao Atualizada',
                'alert-type' => 'success',
            );
        } catch (\QueryException $e) {
            $notification = array(
                'message' => "Falha ao atualizar regra.",
                'alert-type' => 'error',
            );
        }
        return redirect()->route('monitor.all')->with($notification);
    }

    public function MonitorDelete($id)
    {
        try {
            Monitorizacao::destroy($id);
            $notification = array(
                'message' => 'Monitorização deleted',
                'alert-type' => 'success',
            );
        } catch (\QueryException $e) {
            $notification = array(
                'message' => $e,
                'alert-type' => 'error',
            );
        }
        return redirect()->route('monitor.all')->with($notification);
    }
}
