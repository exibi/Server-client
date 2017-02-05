<?php
namespace reciver;
class reciver 
{
    /**
     * data in JSON format
     * @var string 
     */
    private $data = '';
	
	function __construct($params = array()) {
		//$this->data =  $params['data'];
		//$this->content =  $params['content'];
	}
	
	public function getData(){
		return $this->data;
	}	

	public function recive_data(){
		$this->data = file_get_contents('http://esemo.pl/GITexibi/output.php');
	}
}


if (isset($_GET['recivedata'])) {
	$reciver = new reciver(array('data'=>$_GET['data']));
	$reciver->recive_data();
	echo "--".$reciver->getData()."--";	
}


 ?>
