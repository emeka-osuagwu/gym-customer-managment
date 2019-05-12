<?php

namespace Emeka\Console\Commands\Database;

use Emeka\Database\Schemes;
use Emeka\Console\Commands\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterFace;
use Symfony\Component\Console\Output\OutputInterFace;

class RunMigrations extends Command
{
	/**
	* command configure
	*/
	public function configure()
	{
		$this->setName('virtuagym:migrate')->setDescription('Create database migration');
	}

	/**
	* command execute
	*/
	public function execute(InputInterFace $input, OutputInterFace $output)
	{
		$database = new Schemes;

        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' . $database->createUserTable() . '</>',
	        '<info> ===============</>',
        ));

        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' . $database->createPlanTable() . '</>',
	        '<info> ===============</>',
        ));

        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' . $database->createUserPlanTable() . '</>',
	        '<info> ===============</>',
        ));

        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' . $database->createWorkOutTable() . '</>',
	        '<info> ===============</>',
        ));
	}
}