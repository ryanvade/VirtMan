<?php

namespace VirtMan\Storage;

use VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model {
  /**
   * integer ID
   * Date timestamps
   * String name
   * String location
   * string type
   * integer size
   * boolean active
   * boolean initialized
   */
   
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
    return $this->belongsTo('VirtMan\Machine\Machine');
  }

  /**
   * Add Machine
   *
   * Add a Machine to the storage object relationship.
   *
   * @param Machine $machine
   * @return TODO
   */
  public function addMachine(Machine $machine)
  {
    // TODO
  }
}
