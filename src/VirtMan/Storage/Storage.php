<?php

namespace Ryanvade\VirtMan\Storage;

use Ryanvade\VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model {
  protected $table = 'virtman_storage';

  public function machine() {
    return $this->belongsTo('Ryanvade\VirtMan\Machine\Machine');
  }
}
