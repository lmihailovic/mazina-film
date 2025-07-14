<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'zanr_id',
        'Naziv',
        'Status',
        'Budzet',
        'DatumIzlaska',
    ];

    protected $primaryKey = 'FilmId';

    protected $searchableFields = ['*'];

    public $timestamps = false;

    protected $casts = [
        'DatumIzlaska' => 'date',
    ];

    public function zanr()
    {
        return $this->belongsTo(Zanr::class, 'zanr_id', 'ZanrId');
    }

    public function scenas()
    {
        return $this->hasMany(Scena::class, 'film_id', 'FilmId');
    }
}
