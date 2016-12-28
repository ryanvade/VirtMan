<?php

namespace VirtMan;

// Commands
use VirtMan\Command\AddStorage;
use VirtMan\Command\StopMachine;
use VirtMan\Command\AddToNetwork;
use VirtMan\Command\CloneMachine;
use VirtMan\Command\CloneStorage;
use VirtMan\Command\StartMachine;
use VirtMan\Command\CreateMachine;
use VirtMan\Command\CreateNetwork;
use VirtMan\Command\CreateStorage;
use VirtMan\Command\DeleteMachine;
use VirtMan\Command\DeleteNetwork;
use VirtMan\Command\DeleteStorage;

// Models
use VirtMan\Group\Group;
use VirtMan\Machine\Machine;
use VirtMan\Network\Network;
use VirtMan\Storage\Storage;

// Exceptions
use VirtMan\Exceptions\ImpossibleStorageAllocationException;

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
 * @var int
 */
private $maxMemory = 0;

/**
 * Maximum Storage Quota size
 *
 * @var int
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
  $this->connection = $this->connect();
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
   * @return int
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
   * @return int
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
   * @param string $name
   * @param string $type
   * @param int Size
   * @return Storage
   */
  public function createStorage(string $name, string $type, int $size)
  {
    if($size < 0 || $size > $this->maxQuota || $size > $this->remainingStorageSpace())
      throw new ImpossibleStorageAllocationException("Attempting to create storage with an impossible size", 1);

    $command = new CreateStorage($name, $size, $type, $this->connection);
    return $command->run();
  }
}
