<?php
header('Access-Control-Allow-Origin: *');

function deleteElement($element, &$array){
    $index = array_search($element, $array);
    if($index !== false){
        unset($array[$index]);
    }
};

$myapps = array(
		"io.fpgstudio.flippytime",
		"io.fpgstudio.jungleflip",
		"io.fpgstudio.eduappsgames",
		"io.fpgstudio.smartmath",
		"io.fpgstudio.logosmash",
		"io.fpgstudio.jangankedip",
	);
	
	if ( isset($_GET['self']) &&  $_GET['self'] != '') {
		deleteElement($_GET['self'], $myapps);
	}
	
if ( isset($_GET['moreapp']) ) {
	

	
	$schema = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	//$hostlink = 'http://'.$_SERVER['SERVER_NAME'].'/fpg/';
	$hostlink = $schema.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
	$storelink = 'https://play.google.com/store/apps/details?id=';

	$elbefore = '<div class="ourapp">';
	$elafter = '</div>';
	$elclass = 'ourapp';
	$imgsize = '';
	$title = 'Try Our Other Apps!';
	
	$value = $_GET['moreapp'];

	if ( isset($_GET['element']) &&  $_GET['element'] != '') {
		
		if ( isset($_GET['class']) &&  $_GET['class'] != '') {
			$elclass = $_GET['class'];
		}
			
		$elbefore = '<'.$_GET['element'].' class="'.$elclass.'">';
		$elafter = '</'.$_GET['element'].'>';
		
	} 

	if ( isset($_GET['imgsize']) &&  $_GET['imgsize'] != '') {
		
		$imgsize = 'width="'.$_GET['size'].'" height="'.$_GET['size'].'"';
	
	}
	
	if ( isset($_GET['title']) &&  $_GET['title'] != '') {
		
		$title = $_GET['title'];
	
	}
	
	if ($value > 0){
		echo '<div id="ourapps">';
		echo '<div class="moretitle">'.$title.'</div>';
		if ($_GET['element'] == 'li') {
			echo '<ul id="morelist">';
		}

		$randapps=array_rand($myapps, $value);
		
		while($value > 0){
			$appname = $myapps[$randapps[$value-1]];
			
			echo $elbefore."<img src='".$hostlink.'/'.$appname.".png' ".$imgsize." class='getmore' target='".$appname."'>".$elafter;
			$value--;
		}
		if ($_GET['element'] == 'li') {
			echo '</ul>';
		}
		echo '</div>';
	};

} else {
	echo "moreapp=3 // required<br>";
	echo "self=io.studiofpg.myapps<br>";
	echo "element=div<br>";
	echo "class=ourapp<br>";
	echo "imgsize=192<br>";
	echo "title=Try Our Other Apps!<br>";
}

?>
