<?php																															
	////Created by Taias (12/2/2012) (Copyright) Implemented by HolaSpot																

	
$templates = array();

$templates['category'] = '<div class=\"header\">{$category[\'cName\']}</div>
{$gamedata}';

$templates['game'] = '<div class=\"game\">
<p class=\"img\">
<img src=\"{$this->imgdir}/{$game[\'gThumb\']}\" alt=\"{$game[\'gName\']} - {$game[\'gDescription\']}\">
</p>
<p class=\"ic\">
<strong>{$game[\'gName\']}</strong>
<br>
{$game[\'gDescription\']}
<br>
<strong><a href=\"{$_SERVER[\'PHP_SELF\']}?act=play&amp;id={$game[\'gId\']}\" class=\"play\">Play</a></strong>
</p>
<div style=\"clear:both\"></div>
</div>';
				
				
$templates['gdoublewrapper'] = '<div>
{$games}
<div style=\"clear:both\"></div>
</div>';


$templates['list_wrapper_all'] = '<div class=\"header\">{$action}</div>
<p class=\"general\" style=\"margin-bottom: 10px;\">
{$list}
</p>';

$templates['list_repeat_all'] = '<a href=\"{$_SERVER[\'PHP_SELF\']}?act=play&amp;id={$stat[\'gId\']}\">{$stat[\'gName\']}</a><em>{$extra}</em><br>';

$templates['game_play'] = '
<div class=\"playcenter\">
<p class=\"header\">{$game[\'cName\']} &raquo; {$game[\'gName\']}</p>

<object type=\"application/x-shockwave-flash\" data=\"{$this->swfdir}/{$game[\'gSwfFile\']}\" width=\"500\" height=\"400\">
<param name=\"movie\" value=\"{$this->swfdir}/{$game[\'gSwfFile\']}\">
<img src=\"noflash.gif\" width=\"200\" height=\"100\" alt=\"\">
</object>


<p class=\"header\">&nbsp;</p>
<p class=\"general\"><strong>Description: </strong>{$game[\'gDescription\']}<br>
<strong>Player: </strong>You are player number {$this->gamedata[$game[\'gInCategory\']][\'games\'][$game[\'gId\']][\'Played\']}</p>
</div>';
?>