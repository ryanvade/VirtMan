<?php

namespace VirtMan\Network;

use VirtMan\Machine\Machine;
use Illuminate\Database\Eloquent\Model;

class Network extends Model {
  /*
   *
   * int id
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
 * Array specifying which columns can be mass assignable
 *
 * @var array
 */
protected $fillable = [
  'mac',
  'type',
  'model'
];

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
  return $this->hasMany('VirtMan\Machine\Machine');
}

}
