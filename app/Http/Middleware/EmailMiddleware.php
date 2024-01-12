<?php

namespace App\Http\Middleware;

use App\Models\Monitorizacao;
use Closure;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Http\Request;

class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $a = $next($request);

        $monitor = Monitorizacao::select('*')->where('code', $request->id)->first();
        if ($monitor == null) {
            return $a;
        }
        $rules = Monitorizacao::select('regra_envio', 'ativa')->where('id', $monitor->id)->first();
        if ($rules->ativa != 1) {
            return $a;
        }
        $res = Monitorizacao::runRuleCheckProcedure($request->id, $rules->regra_envio);

        if ($res) {
            Monitorizacao::sendEmailOnRuleActivationChange($monitor->sujeito, $monitor);
        }

        return $a;
    }
}
