<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="ValidationError",
 *     @OA\Property(property="field", type="string"),
 *     @OA\Property(property="message", type="string"),
 * )
 */

class APIKey extends Model
{
    use HasFactory;

    protected $table = "api_keys";

    public $timestamps = false;


    protected $fillable = ['key'];
}
