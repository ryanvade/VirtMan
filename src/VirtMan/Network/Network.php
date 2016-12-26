<?php

namespace Ryanvade\VirtMan\Network;

use Ryanvade\VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Network extends Model {
  /*
   *
   * integer id
   * string mac
   * string type
   * string model
   *
   */

   /**
    * Migration Table
    *
    * @var string
    */
protected $table = 'virtman_networks';

/**
 * undocumented function summary
 *
 * Undocumented function long description
 *
 * @param type var Description
 * @return return type
 */
public function machines()
{
  return $this->hasMany('Ryanvade\VirtMan\Machine\Machine');
}

}
