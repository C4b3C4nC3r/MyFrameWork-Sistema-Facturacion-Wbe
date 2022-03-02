<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreateviewsCommand extends Command
{
    protected function configure()
    {
        $this->setName('viewss')
            ->setDescription('Create new view file with extension php')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('viewname', InputArgument::REQUIRED, 'Pass the viewname.');
    }
 
    /**
     * 
     * By Default is Model.php
     * 
     */
    //elementos
    protected $filenameTxt ="resources/views/visualizar/viewConvencion/ConvencionView.txt";
    protected $outMessage; 
    protected $rutaDefault = "resources/views/visualizar/";
    protected $extension =".php";
    //protected $extends="Models";
     
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename =$input->getArgument('viewname')."View";
        $outMessage = $this->newview($filename,$input->getArgument('viewname'));
        //Read Convencion
        $output->writeln(sprintf($outMessage, $filename));
        return -1;
    }
    public function newview(string $filename,string $name)
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
        $fileView = fopen($this->rutaDefault.$filename.$this->extension,"w+");
        if($fileView == false){
            $outMessage = "Insuccessfly , can't create new %s";
        }else{
            if (file_exists($this->rutaDefault.$filename.$this->extension)) {
                $response = fwrite($fileView,sprintf($data,
                strtolower($name),
                ucfirst($name),
                strtoupper($name),
                strtolower($name),
                strtolower($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                ));
                if($response == false){
                    $outMessage = "Insuccessfly , can't create new %s";
                }else{
                    $outMessage = "Successfly , if can create new %s";
                }
            }else{
                $outMessage = "Insuccessfly , can't create new %s";
            }
        }
        fclose($fileView);

        return $outMessage;
    }
}
