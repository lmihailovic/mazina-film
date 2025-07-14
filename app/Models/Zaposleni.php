<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zaposleni extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Ime', 'Prezime', 'Uloga', 'Status'];
    protected $primaryKey = 'ZaposleniId';
    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function scenas()
    {
        return $this->belongsToMany(Scena::class, "scena_zaposleni", "zaposleni_id", "scena_id");
    }
}
