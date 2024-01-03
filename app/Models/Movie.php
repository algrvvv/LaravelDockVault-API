<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static create(array $all)
 * @method static where()
 */
class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];
}
