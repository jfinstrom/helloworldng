<?php
//Our composer and autoloading setup.
//This may not exist yet if we mandate it now we will get an error and can't install the module.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}
/**
 * The BMO class at this point isn't going away. This will be out entry point for the module. It may also need
 * additional methods for FreePBXisms Some legacy stuff even needs to use functions.inc.php In some cases we may
 * use node or ajax for things. that may also route through here. Many things will forward away from this class
 * to other classes. This is just the entry point for the module.
 */
namespace FreePBX\modules;
use FreePBX;
use FreePBX_Helpers;
use BMO;
use FreePBX\Ajax as FreePBXAjax;
use FreePBX\modules\Helloworldng\Container;
use FreePBX\modules\Helloworldng\Utility\DatabaseUtility;
use FreePBX\modules\Helloworldng\Utility\MigrationHandler;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;

class Helloworldng extends FreePBX_Helpers implements BMO
{
	public function __construct(
		?FreePBX|FreePBXAjax $FreePBX = null,
		?Container $container = null,
	) {
		// Are we autoloaded?
		if (class_exist(Container::class)) {
			$this->container = $container ?: new Container();
			$this->container->set(
				'logger',
				$this->container->getLogger($this->FreePBX->Logger),
			);
			$this->container->set('freepbx', $this->container->get('FreePBX'));
		} else {
			$this->container = null; // Fallback if Container class is not available
		}

		if (class_exists('DatabaseUtility')) {
			$this->lumen = new DatabaseUtility();
		} else {
			$this->lumen = null; // Fallback if DatabaseUtility class is not available
		}
	}

	public function install()
	{
		$process = new Process(['which', 'composer']);
		$process->run();
		if ($process->isSuccessful()) {
			out('Composer already installed.');
			$process = new Process(['composer', 'install']);
			$process->run();
			if (!$process->isSuccessful()) {
				out('Composer install failed: ' . $process->getErrorOutput());
				return false;
			}
			out('Composer dependencies installed successfully.');
			// If we need to do more using the autoloader we can include it here.
			return true;
		} else {
			out(
				'Composer not found, install composer manually or with fwconsole helloworldng --installcomposer then run composer install.',
			);
			return true;
		}
	}

	public function uninstall()
	{
		// Uninstallation logic here.
	}

	public function bootDatabase()
	{
		// Database boot logic here.
	}

	public function migrate(
		?string $migratepath = null,
		?OutputInterface $output = null,
	) {
		if ($this->lumen !== null) {
			$this->lumen->migrate($migratepath);
		}
	}
}
