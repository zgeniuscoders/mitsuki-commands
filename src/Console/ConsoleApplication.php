<?php

namespace Mitsuki\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;

class ConsoleApplication
{
    protected Application $app;

    public function __construct(private array $commands)
    {
        $this->app = new Application('Mitsuki Console', '1.0.0');
    }

    public function run()
    {
        $output = new ConsoleOutput();

        $logo = "
<fg=#00ffcc>    __  ___  ____  ______  _____  __  __  __ __  ____</>
<fg=#00ffcc>   /  |/  / /  _/ /_  __/ / ___/ / / / / / // / /  _/</>
<fg=#00ffcc>  / /|_/ / _/ /    / /    \__ \ / /_/ / / , <   _/ /  </>
<fg=#00ffcc> /_/  /_/ /___/   /_/    /____/ \____/ /_/|_|  /___/  </>
<fg=gray> ⚡ Mitsuki Framework | Security Edition</>
";


        $output->writeln($logo);

        foreach ($this->commands as $command) {
            $this->app->addCommand($command);
        }
        $this->app->run();
    }
}
