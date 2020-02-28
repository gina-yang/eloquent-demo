<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $primaryKey = 'GenreId'; // default is "id"
    public $timestamps = false;

    public function tracks(){
        // GenreId is the foreign key column
        return $this->hasMany('App\Track', 'GenreId');
    }
}
