<?php

namespace Ryanvade\VirtMan\Exceptions;

use Ryanvade\VirtMan\Machine\Machine;
use Ryanvade\VirtMan\Storage\Storage;

class NoStorageException extends Exception {
  private $machine = null;
  public function __construct($message, $code = 0, Exception $previous = null, integer $machine_id = null) {
    if($machine_id)
      $this->machine = Machine::find($machine_id);
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    if($this->machine)
      $res .= ': ' . $this->machine->id . '\n';
    return $res;
  }
}
