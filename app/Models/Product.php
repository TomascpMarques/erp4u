<?php

namespace App\Models;

use App\Models\Monitorizacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = "Product";
    public static $table_name = "Product";
    protected $guarded = [];
    public static $gs1 = "9124";

    public static function gerarCodigoITF14($codigo, $corredor, $prateleira): string
    {
        $gs1 = Product::$gs1;
        $cc = (string) $codigo;
        if (strlen($cc) > 4) {
            $cc = substr($cc, 0, 4);
        } else {
            $cc = str_pad($cc, 4, "0");
        }
        $corr = $corredor;
        if (strlen($corr) > 2) {
            $corr = substr($corr, 0, 2);
        } else {
            $corr = str_pad($corr, 2, "0");
        }
        $prat = $prateleira;
        if (strlen($prat) > 2) {
            $prat = substr($prat, 0, 2);
        } else {
            $prat = str_pad($prat, 2, "0");
        }
        $val = $gs1 . $cc . $corr . $prat . "9";
        return $val . Product::calculateGS1CheckDigit($val);
    }

    protected function gerarCodigoGSNProdutoSelf(): string
    {
        // 9124 - O Nosso GS1 company prefix
        $cc = (string) $this->code;
        if (strlen($cc) > 4) {
            $cc = substr($cc, 0, 4);
        } else {
            $cc = str_pad($cc, 4, "0");
        }
        $product_cc = $cc;
        $corr = $this->corredor;
        if (strlen($corr) > 2) {
            $corr = substr($corr, 0, 2);
        } else {
            $corr = str_pad($corr, 2, "0");
        }
        $prat = $this->prateleira;
        if (strlen($prat) > 2) {
            $prat = substr($prat, 0, 2);
        } else {
            $prat = str_pad($prat, 2, "0");
        }
        return $this->gs1 . $product_cc . $corr . $prat . "9";
    }

    public static function calculateGS1CheckDigit($gtinWithoutCheckDigit)
    {
        // Ensure the input is a string
        $gtinWithoutCheckDigit = strval($gtinWithoutCheckDigit);

        // Validate that the input is a 13-digit number
        if (!preg_match('/^\d{13}$/', $gtinWithoutCheckDigit)) {
            return false; // Invalid input
        }

        // Convert the input string into an array of digits
        $digits = str_split($gtinWithoutCheckDigit);

        // Initialize the sum to 0
        $sum = 0;

        // Iterate through each digit, starting from the rightmost position
        for ($i = 12; $i >= 0; $i--) {
            // Multiply the digit by the weight factor (1 or 3, alternating)
            $weight = ($i % 2 === 0) ? 3 : 1;
            $sum += $digits[$i] * $weight;
        }

        // Calculate the check digit (the smallest number to add to the sum to make it a multiple of 10)
        $checkDigit = (10 - ($sum % 10)) % 10;

        return $checkDigit;
    }

    public function generateITF14Code(): string
    {
        $code = $this->gerarCodigoGSNProdutoSelf();
        $check_digit = $this->calculateGS1CheckDigit($code);

        return $code . $check_digit;
    }

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
