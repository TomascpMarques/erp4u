<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "Product";
    protected $guarded = [];

    public function familyLink()
    {
        return $this->belongsTO(Family::class, "family", "family");
    }
    public function unitMeasureLink()
    {
        return $this->belongsTO(UnitMeasure::class, "unit", "unit");
    }
    public function codeRateLink()
    {
        return $this->belongsTO(TaxRate::class, "taxRateCode", "taxRateCode");
    }
    public function monitorizacaoLink()
    {
        return $this->belongsTO(Monotirazao::class, "monotorizado", "code");
    }
    /*public function parteleiraLink()
    {
        return $this->belongsTO(Parteleira::class, "parteleira", "code");
    }*/
}
