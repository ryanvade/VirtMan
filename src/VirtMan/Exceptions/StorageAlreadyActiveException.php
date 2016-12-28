<?php

namespace VirtMan\Exceptions;

use VirtMan\Storage\Storage;

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
   * @param string $message
   * @param int $code
   * @param Exception $previous
   * @param int $storage_id
   * @return None
   */
  public function __construct($message, $code = 0, Exception $previous = null, int $storage_id) {
    $this->storage = Storage::find($storage_id);
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
    $res .= ': ' . $this->storage->id . '\n';
    return $res;
  }
}
