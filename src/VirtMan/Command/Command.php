<?php

namespace Ryanvade\VirtMan\Command;

use Ryanvade\VirtMan\Machine\Machine;

abstract class Command {
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
   * @return None
   */
  protected function __construct(String $name){
    $this->name = $name;
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
