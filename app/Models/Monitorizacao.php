<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RuleStateChange;

class Monitorizacao extends Model
{
    use HasFactory;
    protected $table = "monitorizacao";
    public static $table_name = "monitorizacao";
    protected $guarded = [];

    public static function sendEmailOnRuleActivationChange($subject, $monitor): void
    {
        Mail::to($subject)->send(new RuleStateChange($monitor));
    }

    public static function runRuleCheckProcedure($productCode, $rule): bool
    {
        $model = DB::table(Product::$table_name);
        $model->whereRaw("id = " . $productCode . ' and ' . $rule);
        $res = $model->get()->count();
        return $res;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
