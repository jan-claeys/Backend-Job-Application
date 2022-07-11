<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'country',
        'city',
        'zip_code'
    ];

    protected $casts = [
        'zip_code' => 'integer'
    ];

    public function owners()
    {
        return $this->hasMany(Owner::class);
    }
}
