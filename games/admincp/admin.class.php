<?php

require("../system.class.php");

$sys = new GamesSystem(1);

class GamesAdmin {

	var $output_message;
	
	function GamesAdmin(){
		
		$this->output_message = '';
		if(isset($_GET['cmd'])){
			if(isset($_GET['cmd']) && $_GET['cmd'] == 'nc' || $_GET['cmd'] == 'ng' || $_GET['cmd'] == 'ulswf' || $_GET['cmd'] == 'ulimg'){
				
				if(isset($_GET['cmd']) && isset($_POST['input'])){
					$exec = $this->add($_POST['input']);
					
					$t = 0; $f = 0;
					for($i=0;$i<count($exec);$i++){
						if($exec[$i] != true){
							$f++;
						} else {
							$t++;
						}
					}
					
					switch($_GET['cmd']){
						case 'nc':
						$this->output_message .= '<strong>Adding Category: </strong>';
						break;
						case 'ng':
						$this->output_message .= '<strong>Adding Game: </strong>';
						break;
					}
					
					if($f == 0){
						$this->output_message .= 'The action executed successfully.';
					} elseif($f != 0 && $t > 0){
						$this->output_message .= 'The action cased an error.';
					} else {
						$this->output_message .= 'The action failed... Please retry.';
					}
				}
				
				if(isset($_FILES['upload'])){
				
					if($_GET['cmd'] == 'ulswf'){
						$ft = 'SWF';
					} else {
						$ft = 'Image';
					}
				
					$type = substr($_GET['cmd'], 2);
					
					$r = $this->doUpload($type);
					
					if($r == 'done'){
						$this->output_message .= '<strong>Uploading '.$ft.' File: </strong> The action exectued successfully.';
					} elseif($r == 'failed'){
						$this->output_message .= '<strong>Uploading '.$ft.' File: </strong> The action failed... Please retry.';
					} else {
						$this->output_message .= '<strong>Uploading '.$ft.' File: </strong> Upload Failed... Please ensure you specified the correct file type.';
					}
				
				}
				
			} else {
			
				switch($_GET['cmd']){
				
					case 'cdel':
					$del_subs = "DELETE FROM games WHERE gInCategory = '".$_GET['id']."'";
					if($this->del($_GET['id'],'categories','cId') && $this->cempty($_GET['id'])){
						$this->output_message .= '<strong>Delete Category: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Delete Category: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'delg':
					if($this->del($_GET['id']) && $this->del($_GET['id'],'playstats','pgId')){
						$this->output_message .= '<strong>Delete Game: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Delete Game: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'upg':
					if($this->push($_GET['id'],'-1')){
						$this->output_message .= '<strong>Push Game Up: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Push Game Up: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'cup':
					if($this->push($_GET['id'],'-1','categories','cOrder','cId')){
						$this->output_message .= '<strong>Push Category Up: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Push Category Up: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'cdown':
					if($this->push($_GET['id'],'+1','categories','cOrder','cId')){
						$this->output_message .= '<strong>Push Category Down: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Push Category Down: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'downg':
					if($this->push($_GET['id'],'+1')){
						$this->output_message .= '<strong>Push Game Down: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Push Game Down: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'cempty':
					if($this->cempty($_GET['id'])){
						$this->output_message .= '<strong>Empty Category: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Empty Category: </strong>The action failed... Please retry.';
					}
					break;
					
					case 'edit-done':
					if($this->editc($_POST['cId'], $_POST)){
						$this->output_message .= '<strong>Edit Category: </strong>The action executed successfully.';
					} else {
						$this->output_message .= '<strong>Edit Category: </strong>The action failed... Please retry.';
					}
					break;
				
				}
			
			}
		}
	}
	
	function add($input){
	
		if(isset($input['ignore'])){
			$ignore = explode(',', $input['ignore']);
		} else {
			$ignore = array('submit');
		}
	
		$return = array();
	
		foreach($input as $table => $data){
		
			$query = "INSERT INTO ".$table." (";
			$values = "";
			$fields = "";
			
			foreach($data as $field => $value){
			
				$value = str_replace('\'', "'", $value);
				$value = str_replace('<sql_insert_id>', mysql_insert_id(), $value);
				if(preg_match("/\{/", $value)){
					eval("\$value = \"".stripslashes($value)."\";");
				}
				$fields .= $field.",";
				$values .= '\''.$value.'\',';
			
			}
			
			$query .= substr_replace($fields,"",-1).") VALUES (".substr_replace($values,"",-1).")";
			
			if(@mysql_query($query)){
				$return[] = true;
			} else {
				$return[] = false;
			}
		
		}
		
		return $return;
	
	}
	
	function doUpload($type = 'swf'){
	
		global $sys;
	
		$ext = strtolower(substr($_FILES['upload']['name'], -3));
		
		if(($type == 'swf' && $ext != 'swf') ||
		($type == 'img' && ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'bmp'))){
		
			return 'wft';
			
		} else {
	
			if($type == 'swf'){
				$newfilename = "../".$sys->swfdir.'/'.$_FILES['upload']['name'];
			} else {
				$newfilename = "../".$sys->imgdir.'/'.$_FILES['upload']['name'];
			}
			
			if(move_uploaded_file($_FILES['upload']['tmp_name'], $newfilename)){
				return 'done';
			} else {
				return 'failed';
			}
		
		}
	
	}
	
	function editload($row){
	
		$get = "SELECT * FROM categories WHERE cId = '".$row."'";
		$info = @mysql_query($get);
		$data = @mysql_fetch_assoc($info);
		return $data;
	
	}
	
	function del($id,$tb='games',$field='gId'){
	
		$query = "DELETE FROM ".$tb." WHERE ".$field." = '".$id."'";
		if(@mysql_query($query)){
			return true;
		} else {
			return false;
		}
	
	}
	
	function editc($id, $d){
		
		$query = "UPDATE categories
		SET cName = '".$d['cName']."',
		cOrder = '".$d['cOrder']."',
		cVisible = '".$d['cVisible']."'
		WHERE cId = '".$id."'";
		
		if(@mysql_query($query)){
			return true;
		} else {
			return false;
		}
		
	}
	
	function push($id,$amt,$tb='games',$field1='gOrder',$field2='gId'){
	
		$query = "UPDATE ".$tb." SET ".$field1." = (".$field1.$amt.") WHERE ".$field2." = '".$id."'";
		if(@mysql_query($query)){
			return true;
		} else {
			return false;
		}
		
	}
	
	function cempty($id){
	
		$query = "DELETE FROM games WHERE gInCategory = '".$id."'";
		$query2 = "DELETE FROM playstats WHERE pcId = '".$id."'";
		if(@mysql_query($query) && @mysql_query($query2)){
			return true;
		} else {
			return false;
		}
	
	}

}

?>