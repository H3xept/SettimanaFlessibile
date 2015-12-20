<?php  

function generateRandomString($len) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLen = strlen($chars);
    $rt = '';
    for ($i = 0; $i < $len; $i++) {
        $rt .= $chars[rand(0, $charLen - 1)];
    }
    return $rt;
}

function itoa($int) {
	switch ($int)
	{
		case 1:
			return "one";
		case 2:
			return "two";
		case 3:
			return "three";
		case 4:
			return "four";
		case 5:
			return "five";
		case 6:
			return "six";
		case 7:
			return "seven";
		case 8:
			return "eight";
		case 9:
			return "nine";
	}
}

function itoc($int) {
	switch($int)
	{
		case 0:
			return "";
		case 1:
			return "<span class='label label-success'>X</span>";
		case 2:
			return "<span class='label label-warning'>X</span>";
		case 3:
			return "<span class='label label-info'>X</span>";
	}
}

function itoc_s($int) {
	switch($int)
	{
		case 0:
			return "";
		case 1:
			return "Verde";
		case 2:
			return "Giallo";
		case 3:
			return "Blu";
	}
}
?>