<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $primaryKey = 'InvoiceLineId';
    public $timestamps = false;

    public function invoice(){
        // InvoiceId is the foreign key column
        return $this->belongsTo('App\Invoice', 'InvoiceId');
    }
}
