<?php

namespace VirtMan\Command;

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
   * @param string $name
   * @param Libvirt Resource $connection
   * @return None
   */
  protected function __construct(string $name, $connection){
    $this->name = $name;
    if(!$connection)
      throw new Exception("Attempting to create a " .
                          $this->name."command without a Libvirt connection.", 1);
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
