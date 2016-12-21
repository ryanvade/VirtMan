<?php

namespace Ryanvade\VirtMan\Machine;

use Ryanvade\VirMan\Group\Group;
use Ryanvade\VirtMan\Network\Network;
use Ryanvade\VirtMan\Storage\Storage;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model {

  protected $table = 'virtman_machines';

  public function group()
  {
    return $this->belongsTo('Ryanvade\VirtMan\Group\Group');
  }

  public function network()
  {
    return $this->belongsTo('Ryanvade\VirtMan\Network\Network');
  }

  public function storage()
  {
    return $this->hasMany('Ryanvade\VirtMan\Storage\Storage');
  }

}
