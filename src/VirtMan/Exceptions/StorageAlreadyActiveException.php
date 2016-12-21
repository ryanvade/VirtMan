<?php

namespace Ryanvade\VirtMan\Exceptions;

use Ryanvade\VirtMan\Storage\Storage;

class StorageAlreadyActiveException extends Exception {
  private $storage = null;

  public function __construct($message, $code = 0, Exception $previous = null, Integer $storage_id) {
    $this->storage = Storage::find($storage_id);
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    $res = __CLASS__ . ": [{$this->code}]: {$this->message}";
    $res .= ': ' . $this->storage->id . '\n';
    return $res;
  }
}
