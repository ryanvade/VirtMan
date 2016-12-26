<?php

namespace Ryanvade\VirtMan\Exceptions;

class ImpossibleStorageAllocationException extends Exception {

  /**
   * No Network Exception
   *
   * Exception constructor.
   *
   * @param String $message
   * @param integer $code
   * @param Exception $previous
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null,
  integer $machine_id = null, integer $network_id = null) {
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
    $res = __CLASS__ . ": [{$this->code}]: {$this->message} \n";
    return $res;
  }
}
