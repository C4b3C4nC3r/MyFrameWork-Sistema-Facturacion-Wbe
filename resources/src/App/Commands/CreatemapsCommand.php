<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class CreatemapsCommand extends Command
{
    protected function configure()
    {
        $this->setName('mapp')
            ->setDescription('Create new mapa file with extension php')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('mapname', InputArgument::REQUIRED, 'Pass the mapname.');
    }
 
    /**
     * 
     * By Default is Model.php
     * 
     */
    //elementos
    protected $filenameTxt ="https/model/mapas/mapaconvencion/mapaConvencion.txt";
    protected $outMessage; 
    protected $rutaDefault = "https/model/mapas/";
    protected $extension =".php";

     
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename =$input->getArgument('mapname')."Map";
        $outMessage = $this->newmodel($filename,$input->getArgument('mapname'));
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
        //New Map
        $fileMap = fopen($this->rutaDefault.$filename.$this->extension,"w+");
        if($fileMap == false){
            $outMessage = "Insuccessfly , can't create new %s";
        }else{
            if (file_exists($this->rutaDefault.$filename.$this->extension)) {
                $response = fwrite($fileMap,sprintf($data,
                strtoupper($name),
                ucfirst($name),
                strtolower($name),
                strtolower($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),
                ucfirst($name),
                strtolower($name),

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
        fclose($fileMap);

        return $outMessage;
    }
}
