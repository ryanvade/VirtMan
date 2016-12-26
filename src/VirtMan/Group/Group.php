<?php

namespace Ryanvade\VirtMan\Group;

use Ryanvade\VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {
  /**
   * Migration table
   *
   * @var string
   */
  protected $table = 'virtman_groups';

  /**
   * Machines
   *
   * Machines in the Group.
   *
   * @param None
   * @return Has Many Relationship
   */
  public function machines()
  {
    return $this->hasMany('Ryanvade\VirtMan\Machine\Machine');
  }

}
