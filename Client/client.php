<?php
namespace mgfiles;
class mgfiles 
{
    /**
     * Name of the file
     * @var string
     */
    private $filename = '';
	
	    /**
     * Content of the file
     * @var string 
     */
    private $content = '';
	
	function __construct($params = array()) {
		$this->filename =  $params['filename'];
		$this->content =  $params['content'];
	}

	public function run() {
		$this->createFile();
		$this->saveToFile();
	}
	
	private function createFile() {
		if (!file_exists($this->filename)){
			$newFile= fopen($this->filename, 'w+');
			fclose($newFile);
		}
	}

	private function saveToFile() {
			if (file_exists($this->filename)) {
			$newFile= fopen($this->filename, 'w+');
			fwrite($newFile, $this->content);
			fclose($newFile);
		}
	}

	public function deleteFile() {
		unlink($this->filename);
	}
}

$content = "<?php echo 'TEST 1'; ?>";
$filename= "output.php";

$mgfiles = new mgfiles(array('filename'=>$filename, 'content'=>$content));
$mgfiles->deleteFile();
$mgfiles->run();

 ?>
