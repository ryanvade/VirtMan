<?php

use VirtMan\VirtManServiceProvider;

return [
  /*
   * VirtMan Configuration File
   *
   * username: The libvirt username used for authentication
   * password: Password used to authenticate with Libvirt
   * storageQuota: Maximum size available for Storage Images
   * memoryQuota: Maximum memory available for Machines
   */
   'username' => 'root',
   'password' => 'password',
   'storageQuota' => '0',
   'memoryQuota' => '0'
];
