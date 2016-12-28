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
   * @param string $message
   * @param int $code
   * @param Exception $previous
   * @param int $machine_id
   * @param int $network_id
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null,
  int $machine_id = null, int $network_id = null) {
    if($machine_id)
      $this->machine = Machine::find($machine_id)->first();
    if($network_id)
      $this->network = Network::find($network_id)->first();
    parent::__construct($message, $code, $previous);
  }

 /**
  * To string
  *
  * Generate a description of the exception.
  *
  * @param None
  * @return string
  */
  public function __tostring() {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    if($this->machine)
      $res .= ': ' . $this->machine->id;
    if($this->network)
      $res .= ': ' . $this->network->id . '\n';
    return $res;
  }
}
