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

// Exceptions
use Exceptions\ImpossibleStorageAllocationException;

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
 * Maximum amount of memory for all machines
 *
 * @var Integer
 */
private $maxMemory = 0;

/**
 * Maximum Storage Quota size
 *
 * @var Integer
 */
private $maxQuota = 0;

/**
 * VirtMan
 *
 * VirtMan Constructor
 *
 * @param None
 * @return TODO
 */
public function __construct() {
  $this->authname = config('virtman.username');
  $this->passphrase = config('virtman.password');
  $this->maxQuota = (int)config('virtman.storageQuota');
  $this->maxMemory = (int)config('virtman.memoryQuota');
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
  public function libvirtIsInstalled() {
    return function_exists('libvirt_version');
  }

  /**
   * Connect
   *
   * Authenticate with Libvirt and get the connection resource
   *
   * @param None
   * @return Libvirt Connection resource
   */
  private function connect()
  {
    return libvirt_connect('null', false, [
      VIR_CRED_AUTHNAME => $this->authname,
      VIR_CRED_PASSPHRASE => $this->passphrase
    ]);
  }

  /**
   * Remaining Memory
   *
   * Amount of memory available for new machines
   *
   * @param None
   * @return Integer
   */
  private function remainingMemory()
  {
    $memUsed = 0;
    foreach (Machine::all() as $machine) {
      $memUsed += $machine->size;
    }
    return $this->maxMemory - $memUsed;
  }

  /**
   * Remaining Storage Space
   *
   * Amount of storage space available for new Storage.
   *
   * @param None
   * @return Integer
   */
  private function remainingStorageSpace()
  {
    $storageUsed = 0;
    foreach (Storage::all() as $storage) {
      $storageUsed += $storage->size;
    }
    return $this->maxQuota - $storageUsed;
  }

  /**
   * Create Storage
   *
   * Create a storage object
   *
   * @param String $name
   * @param String $type
   * @param Integer Size
   * @return Storage
   */
  public function createStorage(String $name, String $type, Integer $size)
  {
    if($size < 0 || $size > $this->maxQuota || $size > remainingStorageSpace())
      throw new ImpossibleStorageAllocationException("Attempting to create storage with an impossible size", 1);

    $command = new CreateStorage($name, $size, $type, $this->connection);
    return $command->run();
  }
}
