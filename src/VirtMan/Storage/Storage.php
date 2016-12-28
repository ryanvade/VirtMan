<?php

namespace VirtMan\Storage;

use VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model {
  /**
   * int ID
   * Date timestamps
   * string name
   * string location
   * string type
   * int size
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
   * Array specifying which columns can be mass assignable
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'location',
    'type',
    'size',
    'active',
    'initialized'
  ];

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

  /**
   * Initialize
   *
   * Create the storage image on disk with libvirt.
   *
   * @param Libvirt Connection Resource
   * @return boolean
   */
  public function initialize($connection)
  {
    // TODO
  }
}
