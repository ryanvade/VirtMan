<?php

namespace Ryanvade\VirtMan\Command;

use Ryanvade\VirtMan\Machine\Machine;

abstract class Command {
  protected $name = "";
  protected $machine = null;

  protected function __construct(String $name, Machine $machine){
    $this->name = $name;
    $this->machine = $machine;
  }

  abstract function run();
}
