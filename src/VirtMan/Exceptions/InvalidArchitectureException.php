<?php

namespace VirtMan\Exceptions;

use Exception;

class InvalidArchitectureException extends Exception {
  /**
   * The invalid Architecture
   *
   * @var string
   */
  private $arch = "";

  /**
   * Invalid Architecture Exception
   *
   * Exception for unsupported Architectures.
   *
   * @param string $message
   * @param int $code
   * @param Exception $previous
   * @param string $arch
   * @return return type
   */
  public function __construct($message, $code, $previous = null, $arch)
  {
    $this->arch = $arch;
    parent::__construct($messate, $code, $previous);
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
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    $res .= ": {$this->arch}\n";
    return $res;
  }
}
