<?php

namespace VirtMan\Storage;

use Illuminate\Database\Eloquent\Model;
use VirtMan\Storage\Volume;

class Pool extends Model {
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

   /**
    * undocumented function summary
    *
    * Undocumented function long description
    *
    * @param type var Description
    * @return return type
    */
   public function initialize($value='')
   {
     // TODO: Generate XML
     // TODO: pool = libvirt_storagepool_define_xml($res, $xml, $flags)
     // TODO: bool = libvirt_storagepool_create($pool);
   }


   /**
    * undocumented function summary
    *
    * Undocumented function long description
    *
    * @param type var Description
    * @return return type
    */
   public function delete($value='')
   {
     // TODO: destroy the pool
     // TODO: delete the pool
     // TODO: undefine the pool
   }

}
