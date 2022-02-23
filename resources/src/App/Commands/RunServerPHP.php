<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RunServerPHP extends Command
{
    protected function configure()
    {
        $this->setName('server')
            ->setDescription('Init a server PHP with new Dir Ip ')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('fileindex',InputArgument::REQUIRED,"Pass name of index or principal execution program ");
    }
 
    /**
     * 
     * By Default localhost:8080
     * 
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $init = false;
        $fileindex = $input->getArgument('fileindex').".php";
        $port = "8080";
        $dirIp = "localhost:".$port;
    
        if(file_exists($fileindex)){
            $outMessage = "Sucessfly run server PHP, %s, on the file %s";
            $init = true;
        }else{
            $outMessage = "Insucessfly run server PHP, en %s, on the no exists %s";
        }
        $output->writeln(sprintf($outMessage, $dirIp,$fileindex ));
        echo php_uname()."\n";
        echo PHP_OS."\n";
        if ($init) {
            exec(sprintf("php -S %s %s",$dirIp,$fileindex));
        }
        return -1;
                
    }
    
}

