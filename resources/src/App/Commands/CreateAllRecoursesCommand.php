<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreateAllRecoursesCommand extends Command
{
    protected function configure()
    {
        $this->setName('allr')
            ->setDescription('Create new model,map,view and control files with extension php')
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
        //instance
        $newControl = new CreatecontrollerCommand();
        $newModel =new CreatemodelsCommand();
        $newView =new CreateviewsCommand();
        $newMap = new CreatemapsCommand();
        //filename
        $filenamec =$input->getArgument('llname')."Control";
        $filenamem =$input->getArgument('llname')."Model";
        $filenamev =$input->getArgument('llname')."View";
        $filenamemp =$input->getArgument('llname')."Map";
        //name
        $name = $input->getArgument("llname");
        //out
        $outMessage = $newControl->newcontrol($filenamec,$name);
        $outMessage = $outMessage . "\n".$newModel->newmodel($filenamem,$name);
        $outMessage = $outMessage . "\n".$newView->newview($filenamev,$name);
        $outMessage = $outMessage . "\n".$newMap->newmap($filenamemp,$name);

        $output->writeln(sprintf($outMessage, $filenamec,$filenamem,$filenamev,$filenamemp));
        return -1;
    }
}
