<?php
// vim: set ai ts=4 sw=4 ft=php:

// Namespace should be FreePBX\Console\Command
namespace FreePBX\Console\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class Helloworldng extends Command
{
	protected function configure()
	{
		$this->setName('helloworldng')
			->setDescription('A simple command to say hello world in the new module.')
			->addOption('installcomposer', null, InputOption::VALUE_NONE, 'Install Composer dependencies')
			->addOption('migrations', null, InputOption::VALUE_OPTIONAL, 'Path to migrations directory', 'none');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if ($input->getOption('installcomposer')) {
			//Check if Composer is installed with which
			$process = new \Symfony\Component\Process\Process(['which', 'composer']);
			$process->run();
			if($process->isSuccessful()) {
				$output->writeln('<info>Composer is already installed.</info>');
				return Command::SUCCESS;
			}

			$output->writeln('Installing Composer dependencies...');
			$tmpDir = sys_get_temp_dir();
			$tmpfile = tempnam($tmpDir, 'composer-setup');
			$tmpChecksum  = tempnam($tmpDir, 'composer-checksum');
			if ($tmpChecksum === false) {
				$output->writeln('<error>Failed to create temporary file for Composer checksum.</error>');
				return Command::FAILURE;
			}

			if ($tmpfile === false) {
				$output->writeln('<error>Failed to create temporary file for Composer setup.</error>');
				return Command::FAILURE;
			}
			copy("https://composer.github.io/installer.sig", $tmpChecksum);
			copy('https://getcomposer.org/installer', $tmpfile);
			$checksum = file_get_contents($tmpChecksum);
			if (hash_file('sha384', $tmpfile) !== $checksum) {
				$output->writeln('<error>Composer installer checksum verification failed.</error>');
				unlink($tmpfile);
				unlink($tmpChecksum);
				return Command::FAILURE;
			}
			$output->writeln('<info>Composer installer checksum verified successfully.</info>');
			$process = new \Symfony\Component\Process\Process(['php', $tmpfile, '--quiet']);
			$process->run();
			if (!$process->isSuccessful()) {
				$output->writeln('<error>Composer installation failed: ' . $process->getErrorOutput() . '</error>');
				unlink($tmpfile);
				unlink($tmpChecksum);
				return Command::FAILURE;
			}
			$output->writeln('<info>Composer installed successfully.</info>');
			unlink($tmpfile);
			unlink($tmpChecksum);
			return Command::SUCCESS;
		}
		$migratePath = $input->getOption('migrations');
		if($migratePath !== false) {
			$hw = \FreePBX::Helloworldng();
			if($migratePath === 'none') {
				$migratePath = null; // Use default migrations path
				$output->writeln('<info>No migrations path specified, using default.</info>');
			}
			$hw->migrate($migratePath, $output);
			$output->writeln('<info>Migrations executed successfully.</info>');
		}
		
		return Command::SUCCESS;
	}
}