<?php



namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreatecontrollerCommand extends Command
{
    protected function configure()
    {
        $this->setName('controll')
            ->setDescription('Create new control file with extension php')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('controlname', InputArgument::REQUIRED, 'Pass the controlname.');
    }
 
    /**
     * 
     * By Default is Control.php
     * 
     */
    protected $filenameTxt="https/control/controlConvencion/ConvencionControl.txt";
    protected $rutaDefault = "https/control/controllers/";
    protected $extension =".php";
    protected $extends="Controller";


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //elementos
        $filename =$input->getArgument('controlname')."Control";
        $outMessage = $this->newcontrol($filename,$input->getArgument('controlname'));
        //Read Convencion
        $output->writeln(sprintf($outMessage, $filename));
        return -1;
    }
    public function newcontrol(string $filename,string $name)
    {
        $outMessage="";
        if (file_exists($this->filenameTxt)) {
            $fileTxt = fopen($this->filenameTxt,"r");
            if ($fileTxt == false) {
                $outMessage = "Insuccessfly , can't create new %s";
            }else{
                $data = fread($fileTxt,filesize($this->filenameTxt));
            }
            fclose($fileTxt);
        }else{
            $outMessage = "Insuccessfly , can't create new %s";
        }
        //New Control   
        $fileModel = fopen($this->rutaDefault.$filename.$this->extension,"w+");
        if($fileModel == false){
            $outMessage = "Insuccessfly , can't create new %s";
        }else{
            if (file_exists($this->rutaDefault.$filename.$this->extension)) {
                $response = fwrite($fileModel,sprintf($data,
                strtoupper($filename),
                ucfirst($filename),
                $this->extends,
                strtolower($name)));
                if($response == false){
                    $outMessage = "Insuccessfly , can't create new %s";
                }else{
                    $outMessage = "Successfly , if can create new %s";
                }
            }else{
                $outMessage = "Insuccessfly , can't create new %s";
            }
        }
        fclose($fileModel);

        return $outMessage;
    }
}
