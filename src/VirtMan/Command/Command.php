<?php

namespace Ryanvade\VirtMan\Command;

use Ryanvade\VirtMan\Machine\Machine;

abstract class Command {
  /**
   * Libvirt Connection Resource
   *
   * @var Libvirt Resource
   */
  protected $conn = null;
  /**
   *  Command Name
   *
   * @var string
   */
  protected $name = "";

  /**
   * Command
   *
   * Command constructor.
   *
   * @param String $name
   * @param Libvirt Resource $connection
   * @return None
   */
  protected function __construct(String $name, $connection){
    $this->name = $name;
    $this->conn = $connection;
  }

  /**
   * Run
   *
   * Abstract Command action function.
   *
   * @param None
   * @return Mixed
   */
  abstract public function run();
}
