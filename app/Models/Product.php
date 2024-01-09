<?php

namespace App\Models;

use App\Models\Monitorizacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    public function monitorizacao(): HasOne
    {
        return $this->hasOne(Monitorizacao::class, "product_id");
    }
}
