<?php

namespace App\Models;

use App\Models\Monitorizacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = "Product";
    protected $guarded = [];

    public function familyLink()
    {
        return $this->hasOne(Family::class, "family", "family");
    }
    public function unitMeasureLink()
    {
        return $this->hasOne(UnitMeasure::class, "unit", "unit");
    }
    public function codeRateLink()
    {
        return $this->hasOne(TaxRate::class, "taxRateCode", "taxRateCode");
    }
    public function monitorizacao(): HasMany
    {
        return $this->hasMany(Monitorizacao::class, "product_id");
    }
    /*public function parteleiraLink()
    {
        return $this->belongsTO(Parteleira::class, "parteleira", "code");
    }*/
}
