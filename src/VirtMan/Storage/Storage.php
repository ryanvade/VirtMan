<?php

namespace Ryanvade\VirtMan\Storage;

use Ryanvade\VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model {
  /**
   * Migration Table
   *
   * @var string
   */
  protected $table = 'virtman_storage';

  /**
   * Machine
   *
   * Get the Machine this Storage belongs to
   *
   * @param None
   * @return Belongs To Relationship
   */
  public function machine() {
    return $this->belongsTo('Ryanvade\VirtMan\Machine\Machine');
  }
}
