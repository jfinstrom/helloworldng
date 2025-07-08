<?php 
namespace FreePBX\modules\Helloworldng\Utility;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;


class DatabaseUtility
{

	public function __construct(?Capsule $capsule = null, ?Dispatcher $dispatcher = null, ?Container $container = null) {
		$this->capsule = $capsule ?: new Capsule;
		$this->dispatcher = $dispatcher ?: new Dispatcher($container ?: new Container);
		$this->capsule->setEventDispatcher($this->dispatcher);
		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
	}

	private function getCredentials(string $conf_file = '/etc/freepbx.conf'): array {
		$amp_conf = [];

		if (is_readable($conf_file)) {
			$lines = file($conf_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			foreach ($lines as $line) {
				if (preg_match('/^\$amp_conf\["([^"]+)"\]\s*=\s*"([^"]*)";/', $line, $matches)) {
					$amp_conf[$matches[1]] = $matches[2];
				}
			}
		}
		return [
			'driver' => $amp_conf['AMPDBENGINE'] ?? null,
			'host' => $amp_conf['AMPDBHOST'] ?? null,
			'database' => $amp_conf['AMPDBNAME'] ?? null,
			'username' => $amp_conf['AMPDBUSER'] ?? null,
			'password' => $amp_conf['AMPDBPASS'] ?? null,
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => 'helloworldng_',
		];
	}

	public function schema() {
		return $this->capsule->schema();
	}

	public function migrate($migratepath = null, ?OutputInterface $output = null) {
		$migrationHandler = new MigrationHandler($this->capsule);
		if($migratepath === null) {
			$migratepath = dirname(__DIR__) . '/migrations';

		}
		try {
			$migrationHandler->migrate($migratepath);
			if($output !== null) {
				$output->writeln("Migration completed successfully!");
			} else {
				echo "Migration completed successfully!\n";
			}
	  } catch (Exception $e) {
			if($output !== null) {
				$output->writeln("Migration failed: " . $e->getMessage());
			} else {
				echo "Migration failed: " . $e->getMessage() . "\n";
			}
		}
	}
}