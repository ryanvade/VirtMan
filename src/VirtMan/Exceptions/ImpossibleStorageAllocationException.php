<?php

namespace VirtMan\Exceptions;

use Exception;

class ImpossibleStorageAllocationException extends Exception {

  /**
   * No Network Exception
   *
   * Exception constructor.
   *
   * @param string $message
   * @param int $code
   * @param Exception $previous
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null,
  int $machine_id = null, int $network_id = null) {
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
    $res = __CLASS__ . ": [{$this->code}]: {$this->message} \n";
    return $res;
  }
}
