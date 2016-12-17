<?php
class EmailButton{	
	public $button;
	public function __construct($result){
		$this->button = "<button ><a href='mailto:&bcc=";
		while ($row = mysqli_fetch_array($result)){
			if (!empty($row['Email'])){
				$row = $row['Email'];
				$row = explode(",", $row);
				foreach ($row as $email){
					$email = ltrim($email);
					$email = rtrim($email);
					$row = str_replace("\xc2\xa0", '', $row);
				}
				$row = implode(";", $row);
				$this->button .= $row . ";";
			}
		}
		$this->button .= "'>Napisz do wybranych</a></button>";
		
	}
	function get_button(){
		echo $this->button;
	}
}

?>