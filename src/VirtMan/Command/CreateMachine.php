<?php

namespace VirtMan\Command;

use VirtMan\Command\Command;
use VirtMan\Group\Group;
use VirtMan\Machine\Machine;
use VirtMan\Storage\Storage;
use VirtMan\Network\Network;
use VirtMan\Exceptions\NoStorageException;
use VirtMan\Exceptions\NoNetworkException;
use VirtMan\Exceptions\StorageAlreadyActiveException;

class CreateMachine extends Command {
  /**
   * Created Machine
   *
   * @var Machine
   */
  private $machine = null;

  /**
   * Storage for the Created Machine
   *
   * @var Storage
   */
  private $storage = null;

  /**
   * Created Machine Name
   *
   * @var string
   */
  private $machineName = null;

  /**
   * Created Machine Type
   *
   * @var string
   */
  private $type = null;

  /**
   * Created Machine Architecture
   *
   * @var string
   */
  private $arch = null;

  /**
   * Created Machine Memory Size
   *
   * @var string
   */
  private $memory = null;

  /**
   * Created Machine number of vcpus cores
   *
   * @var ints
   */
  private $cpus = null;

  /**
   * Created Machine Network
   *
   * @var Network
   */
  private $network = null;

  /**
   * Created Machine Group
   *
   * @var Group
   */
  private $group = null;

  /**
   * Libvirt resource from Machine creation
   *
   * @var Libvirt Resource
   */
  private $resource = null;


  /**
    * Create Machine Command
    *
    * Create Machine command constructor
    *
    * @param Storage array $storage
    * @param string $name
    * @param string $type
    * @param string $arch
    * @param int $memory
    * @param int $cpus
    * @param Network $network
    * @param Group $group
    * @param Libvirt Connection $connection
    * @return None
    */
  public function __construct(array $storage, string $name, string $type,
                              string $arch, int $memory, int $cpus,
                              Network $network, Group $group, $connection) {

    if(empty($storage))
      throw new NoStorageException("Attempting to create a machine with no storage.", 1);
    if(!$network)
      throw new NoNetworkException("Attempting to create a machine with no network.", 1);

    parent::__construct("create_machine", $connection);

    $this->arch = $arch;
    $this->memory = $memory;
    $this->cpus = $cpus;
    $this->conn = $conn;
    $this->storage = $storage;
    $this->network = $network;
    $this->group = $group;

    $this->type = ($type)? $type : "nix";
    $this->machineName = ($name)? $name : generateMachineName($this->type);
  }

  /**
    * Run
    *
    * Run the create machine command.
    *
    * @param None
    * @return Machine
    */
  public function run() {
    $this->machine = new Machine([
      'name' => $this->machineName,
      'type' => $this->type,
      'status' => 'installing',
      'arch' => $this->arch,
      'memory' => $this->memory,
      'cpus' => $this->cpus,
      'started_at' => null,
      'stopped_at' => null
    ]);
    $this->machine->storage()->addStorage($this->storage);
    $this->machine->networks()->addNetwork($this->network);
    $this->machine->groups()->addGroup($this->group);
    $this->resource = $this->createMachine();
    return $this->machine;
  }

  /**
    * Generate Machine Name
    *
    * Generate a Machine name given the Machine's type.
    *
    * @param string $type
    * @return string
    */
  private function generateMachineName(string $type) {
    return $type . "Machine" . (Machine::where('type', $type)->count() + 1);
  }

  /**
    * Create Machine
    *
    * Create a libvirt virtual machine.
    *
    * @param None
    * @return Libvirt Resource
    */
  private function createMachine() {
    $iso = $this->getIsoImage();
    $disks = $this->getDisks();
    $networkCard = $this->getNetworkCard();
    return libvirt_domain_new($this->conn, $this->machineName, $this->arch,
                              $this->memory, $this->memory, $this->cpus, $iso,
                              $disks, $networkCards);
  }

  /**
    * Get ISO Image
    *
    * Get the instalation image for the Machine.
    *
    * @param None
    * @return string
    */
  private function getIsoImage() {
    return $this->storage[0]->location;
  }

  /**
    * Get Disks
    *
    * Create Libvirt Storage Images for the Machine.
    *
    * @param None
    * @return Libvirt Image array
    */
  private function getDisks() {
    $disks = [];
    for ($i=1; $i < count($this->storage); $i++) {
      $s = $this->storage[i];
      if($s->active)
        throw new StorageAlreadyActiveException("Attempting to reactivate a storage volume.", 1, null, $s->id);

      if(!$s->initialized)
        $s->initialize($this->conn);
      array_push($disks, libvirt_storagevolume_lookup_by_name($this->conn, $s->name));
      $s->active = True;
      $s->save();
    }
    return $disks;
  }

  /**
    * get Network Card
    *
    * Get the Network Card information for the Machine.
    *
    * @param None
    * @return string array
    */
  private function getNetworkCard() {
    $networkCard = [
        "mac" => $net->mac,
        "network" => $net->type,
        "model" => $net->model
      ];
    return $networkCards;
  }

}
