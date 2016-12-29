<?php

namespace VirtMan\Exceptions;

use Exception;

class InvalidMacException extends Exception {
  /**
   * Invalid Mac Exception
   *
   * Exception for invalid MAC addresses
   *
   * @param string $message
   * @param int $code
   * @param Exception $previous
   * @param string $arch
   * @return return type
   */
  public function __construct($message, $code, $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

  /**
   * To String
   *
   * Get a string representation of the exception.
   *
   * @param None
   * @return string
   */
  public function __tostring()
  {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    return $res;
  }
}
