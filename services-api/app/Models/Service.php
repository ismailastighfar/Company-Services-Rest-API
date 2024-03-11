<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property bool $is_active
 * @property string $location
 * @property string $contact_email
 * @property string $contact_phone
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','is_active','location','contact_email','contact_phone'
    ];
}
