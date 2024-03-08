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
class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','price','is_active','location','contact_email','contact_phone'
    ];
}
