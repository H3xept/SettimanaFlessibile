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

function itoweekday($int) {
	switch($int)
	{
		case 0:
		case 1:
		case 2:
			return "Lunedì";
		case 3:
		case 4:
		case 5:
			return "Martedì";
		case 6:
		case 7:
		case 8:
			return "Giovedì";
	}
}

function itoroman($int)
{
	switch($int)
	{
		case 1:
			return "I";
		case 2:
			return "II";
		case 3:
			return "III";
		case 4:
			return "IV";
		case 5:
			return "V";
		case 6:
			return "VI";
		case 7:
			return "VII";
		case 8:
			return "VIII";
		case 9:
			return "IX";
	}
}

function classtoroman($class)
{
	$classN = itoroman(substr($class, 0,1));
	$section = strtoupper(substr($class, -1,1));
	return $classN . " " . $section;
}

function ntochar($num)
{
	switch ($num) {
		case 1:
			return "A";
		case 2:
			return "B";
		case 3:
			return "C";
		case 4:
			return "D";
		case 5:
			return "E";
	}
}

function raw_class($class)
{
	$classN = romantoi(substr($class, 0,1));
	$section = strtoupper(substr($class, -1,1));
	dd($classN . " " . $section);
	return $classN . " " . $section;
}

function romantoi($roman)
{
	$roman = intval($roman);
	switch($roman)
	{
		case "I":
			return 1;
		case "II":
			return 2;
		case "III":
			return 3;
		case "IV":
			return 4;
		case "V":
			return 5;
		case "VI":
			return 6;
		case "VII":
			return 7;
		case "VIII":
			return 8;
		case "IX":
			return 9;
	}
}

function ttext($stripe)
{
	switch($stripe)
	{
		case 1:
			return "1° e 2° ora";
		case 2:
			return "3° e 4° ora";
		case 3:
			return "5° e 6° ora";
		case 4:
			return "1° e 2° ora";
		case 5:
			return "3° e 4° ora";
		case 6:
			return "5° e 6° ora";
		case 7:
			return "1° e 2° ora";
		case 8:
			return "3° e 4° ora";
		case 9:
			return "5° e 6° ora";
	}
}

function userIsAdmin()
{
	$user = Auth::user();
	return $user->roles()->where('power','>=',10)->get()->first();
}

function userIsMod()
{
	$user = Auth::user();
	return $user->roles()->where('power','>=',8)->get()->first();
}

?>