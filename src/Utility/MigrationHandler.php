<?php

namespace FreePBX\modules\Helloworldng\Utility;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationHandler
{
	protected $capsule;

	public function __construct(Capsule $capsule)
	{
		$this->capsule = $capsule;
		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
	}

	public function migrate($migrationsPath, $dryrun = false)
	{
		$this->createMigrationsTable();

		$sqlStatements = [];
		$executedMigrations = $this->getExecutedMigrations();

		if (is_file($migrationsPath)) {
			// Single file
			if ($dryrun) {
				$this->capsule->getConnection()->enableQueryLog();
			}
			$result = $this->processMigrationFile(
				$migrationsPath,
				$executedMigrations,
				$sqlStatements,
				$dryrun,
			);
			if ($dryrun) {
				$this->capsule->getConnection()->disableQueryLog();
				return $result;
			}
			return;
		} elseif (is_dir($migrationsPath)) {
			// Directory
			$files = glob($migrationsPath . '/*.php');
			if (empty($files)) {
				return $dryrun ? 'No migrations found.' : null;
			}
			usort($files, function ($a, $b) {
				return strcmp(basename($a), basename($b));
			});
			if ($dryrun) {
				$this->capsule->getConnection()->enableQueryLog();
			}
			foreach ($files as $file) {
				$this->processMigrationFile(
					$file,
					$executedMigrations,
					$sqlStatements,
					$dryrun,
				);
			}
			if ($dryrun) {
				$this->capsule->getConnection()->disableQueryLog();
				return implode(";\n", $sqlStatements) .
					(empty($sqlStatements) ? '' : ';');
			}
			return;
		} else {
			throw new \Exception(
				"Migrations path not found at: $migrationsPath",
			);
		}
	}

	/**
	 * Process a single migration file.
	 * @param string $file
	 * @param array $executedMigrations
	 * @param array &$sqlStatements
	 * @param bool $dryrun
	 * @return string|null
	 * @throws \Exception
	 */
	private function processMigrationFile(
		$file,
		$executedMigrations,
		array &$sqlStatements,
		$dryrun = false,
	) {
		$migrationName = pathinfo($file, PATHINFO_FILENAME);
		if (in_array($migrationName, $executedMigrations)) {
			return null;
		}
		try {
			require_once $file;
		} catch (\Throwable $e) {
			throw new \Exception(
				"Failed to include migration file $file: " . $e->getMessage(),
			);
		}
		$className = $this->getClassNameFromFile($file);
		if (!$className || !class_exists($className, false)) {
			throw new \Exception("Migration class not found in $file");
		}
		$migration = new $className();
		if (!($migration instanceof Migration)) {
			throw new \Exception(
				"Class $className in $file does not extend Illuminate\\Database\\Migrations\\Migration",
			);
		}
		try {
			if ($dryrun) {
				// For dry run, capture SQL without executing
				$this->capsule
					->getConnection()
					->pretend(function () use ($migration, &$sqlStatements) {
						$migration->up();
						$queries = $this->capsule
							->getConnection()
							->getQueryLog();
						foreach ($queries as $query) {
							$sqlStatements[] = $this->replaceBindings(
								$query['query'],
								$query['bindings'],
							);
						}
					});
			} else {
				// Execute migration without transaction to avoid FreePBX conflicts
				$migration->up();
				$this->capsule->table('migrations')->insert([
					'migration' => $migrationName,
					'batch' => 1,
				]);
			}
		} catch (\Exception $e) {
			throw new \Exception(
				"Migration $migrationName failed: " . $e->getMessage(),
			);
		}
		if ($dryrun) {
			return implode(";\n", $sqlStatements) .
				(empty($sqlStatements) ? '' : ';');
		}
		return null;
	}

	private function createMigrationsTable()
	{
		if (!$this->capsule->schema()->hasTable('migrations')) {
			$this->capsule
				->schema()
				->create('migrations', function (Blueprint $table) {
					$table->increments('id');
					$table->string('migration');
					$table->integer('batch');
					$table->timestamps();
				});
		}
	}

	private function getExecutedMigrations()
	{
		if (!$this->capsule->schema()->hasTable('migrations')) {
			return [];
		}
		return $this->capsule
			->table('migrations')
			->pluck('migration')
			->toArray();
	}

	private function getClassNameFromFile($file)
	{
		$content = file_get_contents($file);
		$tokens = token_get_all($content);
		$namespace = '';
		$className = null;
		$inNamespace = false;

		for ($i = 0; $i < count($tokens); $i++) {
			if ($tokens[$i][0] === T_NAMESPACE) {
				$inNamespace = true;
				$namespace = '';
				$i += 2;
				while (
					$i < count($tokens) &&
					$tokens[$i][0] !== T_CURLY_OPEN &&
					$tokens[$i] !== ';'
				) {
					if (is_array($tokens[$i])) {
						$namespace .= $tokens[$i][1];
					}
					$i++;
				}
			} elseif ($tokens[$i][0] === T_CLASS && !$className) {
				$i += 2;
				if (isset($tokens[$i][1])) {
					$className = $tokens[$i][1];
				}
			}
		}

		return $namespace ? $namespace . '\\' . $className : $className;
	}

	private function replaceBindings($query, $bindings)
	{
		foreach ($bindings as $binding) {
			if (is_string($binding)) {
				$binding = "'" . addslashes($binding) . "'";
			} elseif (is_null($binding)) {
				$binding = 'NULL';
			}
			$query = preg_replace('/\?/', $binding, $query, 1);
		}
		return $query;
	}
}
