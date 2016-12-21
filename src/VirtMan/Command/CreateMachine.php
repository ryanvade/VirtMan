<?php

namespace Ryanvade\VirtMan\Command;

use Command;
use Ryanvade\VirtMan\Group\Group;
use Ryanvade\VirtMan\Machine\Machine;
use Ryanvade\VirtMan\Storage\Storage;
use Ryanvade\VirtMan\Network\Network;
use Ryanvade\VirtMan\Exceptions\NoStorageException;
use Ryanvade\VirtMan\Exceptions\NoNetworkException;
use Ryanvade\VirtMan\Exceptions\StorageAlreadyActiveException;

class CreateMachine extends Command {
  private $machine = null;
  private $storage = null;
  private $name = null;
  private $type = null;
  private $arch = null;
  private $memory = null;
  private $cpus = null;
  private $network = null;
  private $group = null;
  private $conn = null;

  public function __construct($conn, array $storage, String $name, String $type,
  String $arch, Integer $memory, Integer $cpus, Network $network, Group $group) {
    if(empty($storage))
      throw new NoStorageException("Attempting to create a machine with no storage.", 1);
    if(!$network)
      throw new NoNetworkException("Attempting to create a machine with no network.", 1);
    if(!conn)
      throw new Exception("Attempting to create a machine with no libvirt connection.", 1);

    parent::__construct("create_machine");

    $this->arch = $arch;
    $this->memory = $memory;
    $this->cpus = $cpus;
    $this->conn = $conn;
    $this->storage = $storage;
    $this->network = $network;
    $this->group = $group;

    $this->type = ($type)? $type : "nix";
    $this->name = ($name)? $name : generateMachineName($this->type);
  }

  private function generateMachineName(String $type) {
    return $type . "Machine" . (Machine::where('type', $type)->count() + 1);
  }

  public function run() {
    $this->machine = new Machine([
      'name' => $this->name,
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
    $libvirt_status = createMachine();
    return $this->machine;
  }

  private function createMachine() {
    $iso = getIsoImage();
    $disks = getDisks();
    $networkCards = getNetworkCards();
    return libvirt_domain_new($this->conn, $this->name, $this->arch, $this->memory,
    $this->memory, $this->cpus, $iso, $disks, $networkCards);
  }

  private function getIsoImage() {
    return $this->storage[0]->location;
  }

  private function getDisks(){
    $disks = [];
    for ($i=1; $i < count($this->storage); $i++) {
      $s = $this->storage[i];
      if(!$s->active)
        throw new StorageAlreadyActiveException("Attempting to create a machine with already active storage.", 1, null, $s->id);

      array_push(
        libvirt_image_create($this->conn, $s->name, $s->size, $s->type)
      );
      $s->active = True;
    }
    return $disks;
  }

  private function getNetworkCards()
  {
    $networkCards = [];
    return $networkCards;
  }

}
