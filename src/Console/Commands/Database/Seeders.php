<?php

namespace Emeka\Console\Commands\Database;

use Emeka\Database\Seeder;
use Emeka\Console\Commands\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterFace;
use Symfony\Component\Console\Output\OutputInterFace;

class Seeders extends Command
{
	/**
	* command configure
	*/
	public function configure()
	{
		$this->setName('virtuagym:seed')->setDescription('Seed database');
	}

	/**
	* command execute
	*/
	public function execute(InputInterFace $input, OutputInterFace $output)
	{
		$seeder = new Seeder;

        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' .$seeder->handelUserSeed(10) . '</>',
	        '<info> ===============</>',
        ));
        
        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' .$seeder->handelPlanSeed(10) . '</>',
	        '<info> ===============</>',
        ));
        
        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' .$seeder->handelUserPlanSeed(10) . '</>',
	        '<info> ===============</>',
        ));
        
        $output->writeln(array(
	        '<info>' . getenv("APP_NAME") . ': ' .$seeder->handelWorkoutSeed() . '</>',
	        '<info> ===============</>',
        ));
	}
}