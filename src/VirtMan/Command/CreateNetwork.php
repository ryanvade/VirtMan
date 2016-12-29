<?php

namespace VirtMan\Command;

use VirtMan\Command\Command;
use VirtMan\Network\Network;
use VirtMan\Exceptions\InvalidMacException;

class CreateNetwork extends Command {
  /**
   * The Network MAC Address
   *
   * @var string
   */
  private $mac = "";

  /**
   * The LibVirt "Network"
   *
   * @var string
   */
  private $network = "";

  /**
   * The Network Model
   *
   * @var string
   */
  private $model = "";

  /**
   * The created Network Object
   *
   * @var Network
   */
  private $networkObject = null;

  /**
   * All of the available NIC models
   *
   * @var array string
   */
  private $availableModels = null;

  /**
   * Create Network
   *
   * Create a Network Object
   *
   * @param string $mac
   * @param string $network
   * @param string $model
   * @param Libvirt Connection $connection
   * @return None
   */
  public function __construct(string $mac, string $network, string $model, $connection)
  {
    parent::__construct("create_network", $connection);
    // Get rid of trailing new line
    $nics = libvirt_connect_get_nic_models($connection);
    $nics[count($nics)-1] = substr_replace($nics[count($nics)-1], "", -1, 1);
    $this->availableModels = $nics;

    if(!$this->validateMac($mac))
      throw new InvalidMacException("Attempting to create a network with an invalid MAC.", 1);

    if(!$this->validateModel($model))
      throw new InvalidModelException("Attempting to create a network with an invalid NIC Model", 1);

    $this->mac = $mac;
    $this->network = $network;
    $this->model = $model;


  }

  /**
   * Run
   *
   * Run the create network command
   *
   * @param None
   * @return Network
   */
  public function run()
  {
    $this->networkObject = new Network([
      'mac' => $this->mac,
      'network' => $this->network,
      'model' => $this->model
    ]);

    return $this->networkObject;
  }

  /**
   * Validate MAC
   *
   * Check if the MAC Address is valid
   *
   * @param string $mac
   * @return boolean
   */
  private function validateMac(string $mac)
  {
    // Based on IEEE MAC-48 standard
    return preg_match("/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/", $mac);
  }

  /**
   * Validate Model
   *
   * Check if the NIC Model is valid
   *
   * @param string model
   * @return boolean
   */
  private function validateModel(string $model)
  {
    return in_array($model, $this->availableModels);
  }
}
