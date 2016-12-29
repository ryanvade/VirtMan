<?php

namespace VirtMan\Storage;

use Illuminate\Database\Eloquent\Model;
use VirtMan\Storage\Volume;

class StoragePool extends Model {
  /*
   * string type
   * string name
   * string devicePath nullable
   * string targetPath
   * boolean autostart
   * string hostName nullable
   * string formatType nullable
   * string adapter nullable
   * string authUsername nullable
   * string authType nullable
   * string secretUUID nullable
   * string permissionsMode nullable
   * string permissionsOwner nullable
   * string permissionsGroup nullable
   */

   /**
    * Migration Table
    *
    * @var string
    */
   protected $table = 'virtman_pools';

   /**
    * Array specifying which columns can be mass assignable
    *
    * @var array
    */
   protected $fillable = [
     'type',
     'name',
     'devicePath',
     'targetPath',
     'autostart',
     'hostName',
     'formatType',
     'adapter',
     'authUsername',
     'authType',
     'secretUUID',
     'permissionsMode',
     'permissionsOwner',
     'permissionsGroup'
   ];

}
