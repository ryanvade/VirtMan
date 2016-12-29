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
use VirtMan\Exceptions\ImpossibleMemoryAllocationException;
use VirtMan\Exceptions\InvalidArchitectureException;

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
 * Array of all available Machine types
 *
 * @var string array
 */
private $machineTypes = null;

/**
 * Arary of all supported Image types
 *
 * @var string array
 */
private $imageTypes = [
  'raw',
  'qcow',
  'qcow2'
];

/**
 * VirtMan
 *
 * VirtMan Constructor
 *
 * @param None
 * @return TODO
 */
public function __construct() {
  // Initialize Config Values
  $this->authname = config('virtman.username');
  $this->passphrase = config('virtman.password');
  $this->maxQuota = (int)config('virtman.storageQuota');
  $this->maxMemory = (int)config('virtman.memoryQuota');
  // Attempt to connect to LibVirt
  $this->connection = $this->connect();
  // Initialize Environment Values
  $this->machineTypes = $this->getMachineTypes();

}

  /**
   * Libvirt is Installed
   *
   * Checks if the Libvirt PHP bindings are installed
   *
   * @param None
   * @return boolean
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
   * Get Machine Types
   *
   * Returns all of the available machine types.
   *
   * @param None
   * @return string array
   */
  private function getMachineTypes()
  {
    $keys = array_keys(libvirt_connect_get_machine_types($this->connection));
    $types = [];
    foreach ($keys as $type) {
      // Remove trailing NULL character from each machine type
      array_push($types, substr_replace($type, "", -1, 1));
    }
    return $types;
  }

  /**
   * Create Network
   *
   * Create a Network Object
   *
   * @param string mac
   * @param string network
   * @param string model
   * @return Network
   */
  public function createNetwork(string $mac, string $network, string $model)
  {
    $command = new CreateNetwork();
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

  /**
   * Create Machine
   *
   * Create a Virtual Machine
   *
   * @param string $name
   * @param string $type
   * @param int $memory
   * @param int $numCpus
   * @param string $arch
   * @param Storage array $storage
   * @param Network $network
   * @param Group $group
   * @return Machine
   */
  public function createMachine(string $name, string $type, int $memory,
                              int $numCpus, string $arch, array $storage,
                              Network $network, Group $group)
  {
    if($memory < 0 || $memory > $this->maxMemory || $memory > $this->remainingMemory())
      throw new ImpossibleMemoryAllocationException("Attempting to create a machine with an impossible memory size.", 1);

    if(!in_array($arch, $this->machineTypes))
      throw new InvalidArchitectureException("Attempting to create a machine with an unsupported Architecture", 1, null, $arch);

    $command = new CreateMachine($storage, $name, $type, $arch, $memory, $numCpus,
                                $network, $group, $this->connection);
    return $command->run();
  }
}
