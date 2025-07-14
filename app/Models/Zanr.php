<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zanr extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Naziv'];
    protected $primaryKey = 'ZanrId';

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function films()
    {
        return $this->hasMany(Film::class, 'zanr_id', 'ZanrId');
    }
}
