<?php

namespace VirtMan\Storage;

use VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;
use VirtMan\Exceptions\NoLibvirtConnectionException;

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
    if(!$connection)
      throw new NoLibvirtConnectionException("Attempting to use libvirt without an active connection.", 1);

    if($this->active || $this->initialized)
      throw new StorageAlreadyActiveException("Attempting to reinitialize a storage volume.", 1, null, $this->id);

    // TODO check for ISO type and throw exception should we attempt to initialize it

    $hostname = libvirt_image_create($connection, $this->name, $this->size, $this->type);
    if($hostname !== False)
      $this->initialized = True;
    return $hostname !== False;
  }
}
