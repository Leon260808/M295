<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    /** @use HasFactory<\Database\Factories\PlantFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'stock'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
