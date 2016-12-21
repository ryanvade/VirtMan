<?php

namespace Ryanvade\VirtMan;

// Commands
use Ryanvade\VirtMan\Command\AddStorage;
use Ryanvade\VirtMan\Command\StopMachine;
use Ryanvade\VirtMan\Command\AddToNetwork;
use Ryanvade\VirtMan\Command\CloneMachine;
use Ryanvade\VirtMan\Command\CloneStorage;
use Ryanvade\VirtMan\Command\StartMachine;
use Ryanvade\VirtMan\Command\CreateMachine;
use Ryanvade\VirtMan\Command\CreateNetwork;
use Ryanvade\VirtMan\Command\CreateStorage;
use Ryanvade\VirtMan\Command\DeleteMachine;
use Ryanvade\VirtMan\Command\DeleteNetwork;
use Ryanvade\VirtMan\Command\DeleteStorage;

// Models
use Ryanvade\VirtMan\Group\Group;
use Ryanvade\VirtMan\Machine\Machine;
use Ryanvade\VirtMan\Network\Network;
use Ryanvade\VirtMan\Storage\Storage;

class VirtMan {

  public function __construct() {

  }

}
