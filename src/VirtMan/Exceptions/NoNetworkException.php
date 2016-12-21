<?php

namespace Ryanvade\VirtMan\Exceptions;

use Ryanvade\VirtMan\Machine\Machine;
use Ryanvade\VirtMan\Storage\Storage;
use Ryanvade\VirtMan\Network\Network;

class NoNetworkException extends Exception {
  private $machine = null;
  private $network = null;
  public function __construct($message, $code = 0, Exception $previous = null,
  integer $machine_id = null, integer $network_id = null) {
    if($machine_id)
      $this->machine = Machine::find($machine_id)->first();
    if($network_id)
      $this->network = Network::find($network_id)->first();
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    if($this->machine)
      $res .= ': ' . $this->machine->id;
    if($this->network)
      $res .= ': ' . $this->network->id . '\n';
    return $res;
  }
}
