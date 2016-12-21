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

  protected $table = 'virtman_machines';

  public function groups()
  {
    return $this->belongsTo('Ryanvade\VirtMan\Group\Group');
  }

  public function addGroup($group)
  {

  }

  public function networks()
  {
    return $this->belongsTo('Ryanvade\VirtMan\Network\Network');
  }

  public function addNetwork($network)
  {

  }

  public function storage()
  {
    return $this->hasMany('Ryanvade\VirtMan\Storage\Storage');
  }

  public function addStorage($storage)
  {

  }

}
