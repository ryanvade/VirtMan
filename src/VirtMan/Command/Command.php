<?php

namespace Ryanvade\VirtMan\Command;

use Ryanvade\VirtMan\Machine\Machine;

abstract class Command {
  protected $name = "";

  protected function __construct(String $name){
    $this->name = $name;
  }

  abstract public function run();
}
