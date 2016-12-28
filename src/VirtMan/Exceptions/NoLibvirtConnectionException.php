<?php

namespace VirtMan\Exceptions;

use Exception;

class NoLibvirtConnectionException extends Exception {
  /**
   * No Libvirt Connection Exception
   *
   * Exception Constructor
   *
   * @param string $message
   * @param int code
   * @param Exception previous
   * @return None
   */
  public function __construct($message, $code, $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

  /**
   * To String
   *
   * Generate a description of the exception.
   *
   * @param None
   * @return string
   */
  public function __tostring()
  {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    return $res;
  }
}
