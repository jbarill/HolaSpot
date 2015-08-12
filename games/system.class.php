<?php
	////	Created by Taias (12/2/2012) (Copyright) Implemented  by HolaSpot																

	
/* Date | GamesPlayed */
	require("config.php");
	require("templates.tpl.php");

class GamesSystem {

	var $gamedata;
	var $imgdir;
	var $swfdir;
	var $loaded;
	var $template;
	var $am;

	function GamesSystem($admin_mode = 0){
		if($admin_mode != 1){
			global $templates;
			$this->template = $templates;
		}
		$this->gamedata = array();
		$this->imgdir = './images';
		$this->loaded = false;
		$this->swfdir = './swf';
		$this->am = $admin_mode;
	}

	function vQ($info){
		if($this->am == 1){
			return $info.' != \'1\'';
		} else {
			return '';
		}
	}

	function Load(){
		$getCategories = "SELECT cId,cName FROM categories WHERE cVisible = '1' ".$this->vQ('OR cVisible')." ORDER BY cOrder ASC";
		if($cats = @mysql_query($getCategories)){
			while($category = @mysql_fetch_assoc($cats)){
				$this->gamedata[$category['cId']] = $category;
				$this->gamedata[$category['cId']]['games'] = array();
			}
			$this->gamedata[0] = array('cId' => 0, 'cName' => 'Other Games', 'games' => array());
			$getGameData = "SELECT g.gId, g.gDescription, g.gSwfFile, g.gVisible, g.gInCategory, g.gThumb, g.gName, p.Played FROM
			games as g, playstats as p WHERE g.gId = p.pgId AND g.gVisible = '1' ".$this->vQ('OR g.gVisible')."
			ORDER BY gOrder ASC, p.Played DESC";
			if($games = @mysql_query($getGameData)){
				while($game = @mysql_fetch_assoc($games)){
					if(!isset($this->gamedata[$game['gInCategory']])){
						$game['gInCategory'] = 0;
					}
					$this->gamedata[$game['gInCategory']]['games'][$game['gId']] = $game;
				}
				$this->loaded = true;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function addPlay($gid){
		$quickcheck = "SELECT Date FROM gamestoday WHERE Date = '".date("dmy")."'";
		if(@mysql_num_rows(mysql_query($quickcheck)) < 1){
			@mysql_query("INSERT INTO gamestoday VALUES ('".date("dmy")."', 0)");
		}
		$update = "UPDATE playstats SET Played = (Played+1) WHERE pgId = '".$gid."'";
		$update2 = "UPDATE gamestoday SET GamesPlayed = (GamesPlayed+1) WHERE Date = '".date("dmy")."'";
		if(@mysql_query($update) && @mysql_query($update2)){
			return true;
		} else {
			return false;
		}
	}

	function loadPlay($gid,$cid){
		if($cid == 0){
			$load = "SELECT g.gId,g.gSwfFile,g.gName,g.gInCategory,g.gDescription,g.gWidth,g.gHeight FROM
			games as g WHERE g.gId='".$gid."'";
		} else {
			$load = "SELECT g.gId,g.gSwfFile,g.gName,g.gInCategory,g.gDescription,g.gWidth,g.gHeight,c.cName FROM
			games as g, categories as c WHERE g.gId='".$gid."' AND g.gInCategory = c.cId";
		}
		if($data = @mysql_query($load)){
			$data = @mysql_fetch_assoc($data);
			if($cid == 0){
				$data['cName'] = 'Other Games';
			}
			return $data;
		} else {
			return false;
		}
	}

	function isLoaded(){
		if($this->loaded == true){
			return true;
		} else {
			return false;
		}
	}

	function makeGamesList(){
		if(!$this->isLoaded()){
			$this->Load();
		}
		$output = "";
		foreach($this->gamedata as $category){
			$games = "";
			$gamedata = "";
			if(count($category['games']) > 0){
				$count = 0;
				foreach($category['games'] as $game){
					if(($count % 2) == 1 || count($category['games']) == 1){
						eval("\$games .= \"".$this->template['game']."\";");
						eval("\$gamedata .= \"".$this->template['gdoublewrapper']."\";");
						$games = "";
					} else {
						eval("\$games .= \"".$this->template['game']."\";");
					}
					$count++;

					if(count($category['games']) != 1 && (count($category['games']) % 2) == 1 && ($count == count($category['games']))){
						eval("\$gamedata .= \"".$this->template['gdoublewrapper']."\";");
					}
				}
				eval("\$output .= \"".$this->template['category']."\";");
			}
		}
		return $output;
	}

	function doMostPlayed($showonly = 10){
		$list = "";
		$action = "Top Games";
		$getRecent = "SELECT pcId,pgId FROM playstats ORDER BY Played DESC LIMIT ".$showonly;
		if($data = @mysql_query($getRecent)){
			while($statdata = @mysql_fetch_assoc($data)){
				$stat = $this->gamedata[$statdata['pcId']]['games'][$statdata['pgId']];
				$extra = ' [ '.$stat['Played'].' plays ]';
				eval("\$list .= \"".$this->template['list_repeat_all']."\";");
			}
			eval("\$return = \"".$this->template['list_wrapper_all']."\";");
			return $return;
		} else {
			return false;
		}
	}

	function doNewestGames($limit = 10){
		$action = 'Newest Games';
		$list = "";
		$getRecent = "SELECT gId,gInCategory FROM games ORDER BY gId DESC LIMIT ".$limit;
		if($data = @mysql_query($getRecent)){
			while($statdata = @mysql_fetch_assoc($data)){
				$stat = $this->gamedata[$statdata['gInCategory']]['games'][$statdata['gId']];
				$extra ='';
				eval("\$list .= \"".$this->template['list_repeat_all']."\";");
			}
			eval("\$return = \"".$this->template['list_wrapper_all']."\";");
			return $return;
		} else {
			return false;
		}
	}

	function makeGameHtml($id,$cid){
		$game = $this->loadPlay($id,$cid);
		eval("\$html = \"".$this->template['game_play']."\";");
		return $html;
	}

	function makeOptionList(){

		$opt = "";
		$sortorder = array();
		foreach($this->gamedata as $category){
			foreach($category['games'] as $game){
				$sortorder[$game['gName']] = array($category['cId'], $game['gId']);
			}
		}
		ksort($sortorder);
		foreach($sortorder as $game){
			$opt .= '<option value="'.$_SERVER['PHP_SELF'].'?act=play&amp;id='.$this->gamedata[$game[0]]['games'][$game[1]]['gId'].'&amp;cid='.$this->gamedata[$game[0]]['games'][$game[1]]['gInCategory'].'">'.$this->gamedata[$game[0]]['games'][$game[1]]['gName'].'</option>';
		}

		return $opt;

	}

	function getPlaysToday(){
		$get = "SELECT GamesPlayed FROM gamestoday WHERE Date = '".date("dmy")."'";
		if($data = @mysql_query($get)){
			$num = mysql_fetch_row($data);
			return $num[0];
		} else {
			return '';
		}
	}

}

?>
