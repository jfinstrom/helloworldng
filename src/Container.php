<?php
namespace FreePBX\modules\Helloworldng;
use FreePBX\Ajax as FreePBXAjax;
use FreePBX;
use FreePBX\modules\Helloworldng\Interfaces\LoggerInterface;
use FreePBX\modules\Helloworldng\Logger\FreePBXLogger;

class Container
{
	private $services = [];

	public function set($key, $service)
	{
		$this->services[$key] = $service;
	}

	public function get($key)
	{
		if (!isset($this->services[$key])) {
			throw new \Exception("Service {$key} not found in container");
		}
		return $this->services[$key];
	}

	public function getLogger($freePBXLogger): LoggerInterface
	{
		if (!isset($this->services['logger'])) {
			$this->services['logger'] = new FreePBXLogger($freePBXLogger);
		}
		return $this->services['logger'];
	}
	public function getFreePBX($FreePBX): FreePBX|FreePBXAjax
	{
		if (!isset($this->services['freepbx'])) {
			$this->services['freepbx'] = $FreePBX;
		}
		return $this->services['freepbx'];
	}
}
