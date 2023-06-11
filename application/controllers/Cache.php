<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

  public function clearCache() {
    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    $this->cache->clean();
    echo "done";
    die();
  }
}
