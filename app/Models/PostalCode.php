<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostalCode extends Model
{
    use HasFactory;
    protected $table = "postalcode";
    protected $guarded = [];
}
