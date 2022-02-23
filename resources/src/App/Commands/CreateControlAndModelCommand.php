<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreateControlAndModelCommand extends Command
{
    protected function configure()
    {
        $this->setName('ll')
            ->setDescription('Create new model and control files with extension php')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('llname', InputArgument::REQUIRED, 'Pass the llname.');
    }
 
    /**
     * 
     * By Default is Model.php and Control.php
     * 
     */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outMessage= "";
        $newControl = new CreatecontrollerCommand();
        $newModel =new CreatemodelsCommand();
        $filenamec =$input->getArgument('llname')."Control";
        $filenamem =$input->getArgument('llname')."Model";
        $name = $input->getArgument("llname");
        $outMessage = $newControl->newcontrol($filenamec,$name);
        $outMessage = $outMessage . "\n".$newModel->newmodel($filenamem,$name);
        $output->writeln(sprintf($outMessage, $filenamec,$filenamem));
        return -1;
    }
}
