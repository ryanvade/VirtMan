<?php

namespace Ryanvade\VirtMan\Machine;

use Ryanvade\VirMan\Group\Group;
use Ryanvade\VirtMan\Network\Network;
use Ryanvade\VirtMan\Storage\Storage;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model {
  /*
   * Machine Model:
   * integer id
   * string name
   * string type
   * string status
   * string arch
   * integer memory (mB)
   * integer cpus
   * date started_at
   * date stopped_at
   * date timestamps
   */

  /**
   * Migration Table
   *
   * @var string
   */
  protected $table = 'virtman_machines';

  /**
    * Machines Groups
    *
    * Get the groups a machine belongs to.
    *
    * @param None
    * @return Belongs To Relationship
    */
  public function groups()
  {
    return $this->belongsTo('Ryanvade\VirtMan\Group\Group');
  }

  /**
   * Add Group
   *
   * Add a Group or array of groups to the machine.
   *
   * @param TODO
   * @return TODO
   */
  public function addGroup(Group $group)
  {
    // TODO
  }

  /**
    * Machines Networks
    *
    * Get the networks a machine belongs to.
    *
    * @param None
    * @return Belongs To Many Relationship
    */
  public function networks()
  {
    return $this->belongsToMany('Ryanvade\VirtMan\Network\Network');
  }

  /**
    * Machines Networks
    *
    * Get the networks a machine belongs to.
    *
    * @param TODO
    * @return TODO
    */
  public function addNetworks($network)
  {
    // TODO
  }

  /**
    * Machines Networks
    *
    * Get the networks a machine belongs to.
    *
    * @param None
    * @return Has Many Relationship
    */
  public function storage()
  {
    return $this->hasMany('Ryanvade\VirtMan\Storage\Storage');
  }

  /**
    * Machines Networks
    *
    * Get the networks a machine belongs to.
    *
    * @param TODO
    * @return TODO
    */
  public function addStorage($storage)
  {
    // TODO
  }

}
