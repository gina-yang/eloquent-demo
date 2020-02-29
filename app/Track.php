<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $primaryKey = 'TrackId'; // default is "id"
    public $timestamps = false;

    public function genre(){
        // GenreId is the foreign key column
        return $this->belongsTo('App\Genre', 'GenreId');
    }

    public function album(){
        // AlbumId is the foreign key column
        return $this->belongsTo('App\Album', 'AlbumId');
    }
}
