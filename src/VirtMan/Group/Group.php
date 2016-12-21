<?php

namespace Ryanvade\VirtMan\Group;

use Ryanvade\VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

  protected $table = 'virtman_groups';

  public function machines()
  {
    return $this->hasMany('Ryanvade\VirtMan\Machine\Machine');
  }

}
