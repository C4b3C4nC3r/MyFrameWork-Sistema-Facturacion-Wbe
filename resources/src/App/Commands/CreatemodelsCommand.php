<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreatemodelsCommand extends Command
{
    protected function configure()
    {
        $this->setName('modell')
            ->setDescription('Create new model file with extension php')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('modelname', InputArgument::REQUIRED, 'Pass the modelname.');
    }
 
    /**
     * 
     * By Default is Model.php
     * 
     */
    //elementos
    protected $filenameTxt ="https/model/modelConvencion/ConvencionModel.txt";
    protected $outMessage; 
    protected $rutaDefault = "https/model/models/";
    protected $extension =".php";
    protected $extends="Models";

     
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename =$input->getArgument('modelname')."Model";
        $outMessage = $this->newmodel($filename,$input->getArgument('modelname'));
        //Read Convencion
        $output->writeln(sprintf($outMessage, $filename));
        return -1;
    }
    public function newmodel(string $filename,string $name)
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
                $this->extends));
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
