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

$content = '
<?php
$curl = curl_init(\'http://www.google.com\'); 
curl_setopt($curl, CURLOPT_FAILONERROR, true); 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 

$result = curl_exec($curl); 
$getinfo = curl_getinfo($curl);
$size = $getinfo["size_download"]/1000000;
echo "website size: ".round($size,2)."Mb<pre>";
print_r($getinfo);
echo "<br><br>";
//echo $result; 
?>
';
/*$content = "<?php echo 'TEST 1'; ?>";*/
$filename= "output.php";

$mgfiles = new mgfiles(array('filename'=>$filename, 'content'=>$content));
$mgfiles->deleteFile();
$mgfiles->run();

 ?>
