<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'cropName',
        'mainImagePath',
        'subImagePaths',
        'zone',
        'soilType',
        'selectedSeason',
        'selectedWateringCycle',
        'weeklyOption',
        'timeOption',
        'dailyOption',
        'selectedDiseaseList',
        'cropVariety',
        'lifeCycleDescription',
        'lifeCycleImagePaths',
        'isFavorite'
    ];

    protected $casts = [
        'subImagePaths' => 'json',
        'selectedDiseaseList' => 'json',
        'lifeCycleImagePaths' => 'json',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
