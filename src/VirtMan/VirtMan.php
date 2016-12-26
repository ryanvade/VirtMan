<?php

namespace Ryanvade\VirtMan;

// Commands
use Command\AddStorage;
use Command\StopMachine;
use Command\AddToNetwork;
use Command\CloneMachine;
use Command\CloneStorage;
use Command\StartMachine;
use Command\CreateMachine;
use Command\CreateNetwork;
use Command\CreateStorage;
use Command\DeleteMachine;
use Command\DeleteNetwork;
use Command\DeleteStorage;

// Models
use Group\Group;
use Machine\Machine;
use Network\Network;
use Storage\Storage;

class VirtMan {

  /**
   * Library Version
   *
   * @var string
   */
  const VERSION = '0.0.1';

  /**
   * Libvirt Domain Connection
   *
   * @var Libvirt Connection
   */
private $connection = null;

/**
 * Libvirt server User
 *
 * @var string
 */
private $authname = null;

/**
 * Libvirt serrver Password
 *
 * @var string
 */
private $passphrase = null;

/**
 * VirtMan
 *
 * VirtMan Constructor
 *
 * @param None
 * @return TODO
 */
public function __construct() {
  $this->connection = connect();

}

  /**
   * undocumented function summary
   *
   * Undocumented function long description
   *
   * @param type var Description
   * @return return type
   */
  protected function libvirtIsInstalled() {
    return function_exists('libvirt_version');
  }

  /**
   * undocumented function summary
   *
   * Undocumented function long description
   *
   * @param type var Description
   * @return return type
   */
  private function connect()
  {
    return libvirt_connect('null', false, [
      VIR_CRED_AUTHNAME => $this->authname,
      VIR_CRED_PASSPHRASE => $this->passphrase
    ]);
  }

}
