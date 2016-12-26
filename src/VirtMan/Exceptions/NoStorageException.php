<?php

namespace Ryanvade\VirtMan\Exceptions;

use Ryanvade\VirtMan\Machine\Machine;
use Ryanvade\VirtMan\Storage\Storage;

class NoStorageException extends Exception {
  /**
   * Machine associated with the exception.
   *
   * @var Machine
   */
  private $machine = null;

  /**
   * No Storage Exception
   *
   * Exception constructor.
   *
   * @param String $message
   * @param integer $code
   * @param Exception $previous
   * @param integer $machine_id
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null,
                              integer $machine_id = null) {
    if($machine_id)
      $this->machine = Machine::find($machine_id);
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
      $res .= ': ' . $this->machine->id . '\n';
    return $res;
  }
}
