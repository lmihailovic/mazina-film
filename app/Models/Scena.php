<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scena extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['film_id', 'Lokacija', 'DatumSnimanja'];
    protected $primaryKey = 'ScenaId';

    protected $searchableFields = ['*'];

    public $timestamps = false;

    protected $casts = [
        'DatumSnimanja' => 'date',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'FilmId');
    }

    public function zaposlenis()
    {
        return $this->belongsToMany(Zaposleni::class, "scena_zaposleni", "scena_id", "zaposleni_id");
    }
}
