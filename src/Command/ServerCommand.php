<?php

namespace Mitsuki\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'run:serve', description: 'Starts the Mitsuki development server')]
class ServerCommand extends Command
{
    private $process = null;

    protected function configure(): void
    {
        $this->addOption('host', 'H', InputOption::VALUE_OPTIONAL, 'Server host', '127.0.0.1')
             ->addOption('port', 'p', InputOption::VALUE_OPTIONAL, 'Server port', '8000');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $host = $input->getOption('host');
        $port = $input->getOption('port');
        $router = 'public/index.php'; 
        $docroot = getcwd();

        $io->writeln(" <bg=green;fg=black> INFO </> Starting Mitsuki server...");
        $io->newLine();

        $cmd = sprintf('php -S %s:%s -t %s %s 2>&1', $host, $port, $docroot, $router);
        $this->process = proc_open($cmd, [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'], 
        ], $pipes);

        if (!is_resource($this->process)) {
            $io->error('Unable to start server.');
            return Command::FAILURE;
        }

        $url = "http://{$host}:{$port}";
        $io->writeln(" <bg=green;fg=black> INFO </> Server started on <href={$url}>{$url}</>");
        $io->writeln(' Press Ctrl+C to stop.');

        while ($line = fgets($pipes[1])) {
            $output->writeln(trim($line));
        }

        proc_close($this->process);
        return Command::SUCCESS;
    }
}
