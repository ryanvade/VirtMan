<?php

namespace Ryanvade\VirtMan\Exceptions;

use Ryanvade\VirtMan\Storage\Storage;

class StorageAlreadyActiveException extends Exception {
  /**
   * Storage associated with the exception
   *
   * @var Storage
   */
  private $storage = null;

  /**
   * Storage Already Active Exception
   *
   * Exception constructor.
   *
   * @param String $message
   * @param integer $code
   * @param Exception $previous
   * @param integer $storage_id
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null, Integer $storage_id) {
    $this->storage = Storage::find($storage_id);
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
    $res .= ': ' . $this->storage->id . '\n';
    return $res;
  }
}
