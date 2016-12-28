<?php

namespace VirtMan\Exceptions;

use VirtMan\Machine\Machine;
use VirtMan\Storage\Storage;
use VirtMan\Network\Network;

class NoNetworkException extends Exception {
  /**
   * Machine associated with the exception
   *
   * @var Machine
   */
  private $machine = null;
  /**
   * Network associated with the exception
   *
   * @var Network
   */
  private $network = null;

  /**
   * No Network Exception
   *
   * Exception constructor.
   *
   * @param String $message
   * @param integer $code
   * @param Exception $previous
   * @param integer $machine_id
   * @param integer $network_id
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null,
  integer $machine_id = null, integer $network_id = null) {
    if($machine_id)
      $this->machine = Machine::find($machine_id)->first();
    if($network_id)
      $this->network = Network::find($network_id)->first();
    parent::__construct($message, $code, $previous);
  }

 /**
  * To String
  *
  * Generate a description of the exception.
  *
  * @param None
  * @return String
  */
  public function __toString() {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    if($this->machine)
      $res .= ': ' . $this->machine->id;
    if($this->network)
      $res .= ': ' . $this->network->id . '\n';
    return $res;
  }
}
