<?php
namespace FreePBX\modules\Helloworldng\Logger;

use FreePBX\modules\Helloworldng\Interfaces\LoggerInterface;
use FreePBX\Logger as FreePBXLoggerObject;

class FreePBXLogger implements LoggerInterface
{
	private $logger;
	private $channel = 'helloworldng';

	public function __construct($freePBXLogger)
	{
		$this->logger = $freePBXLogger; // Expecting FreePBX\Logger instance
	}

	public function emergency($message, array $context = [])
	{
		$this->logger->channelLogWrite(
			$this->channel,
			$message,
			$context,
			FreePBXLoggerObject::EMERGENCY,
		);
	}

	public function alert($message, array $context = [])
	{
		$this->logger->channelLogWrite(
			$this->channel,
			$message,
			$context,
			FreePBXLoggerObject::ALERT,
		);
	}

	public function critical($message, array $context = [])
	{
		$this->logger->channelLogWrite(
			$this->channel,
			$message,
			$context,
			FreePBXLoggerObject::CRITICAL,
		);
	}

	public function error($message, array $context = [])
	{
		$this->logger->channelLogWrite(
			$this->channel,
			$message,
			$context,
			FreePBXLoggerObject::ERROR,
		);
	}

	public function warning($message, array $context = [])
	{
		$this->logger->channelLogWrite(
			$this->channel,
			$message,
			$context,
			FreePBXLoggerObject::WARNING,
		);
	}
}
