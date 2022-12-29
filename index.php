<?php 
include 'array.php';
function getPartsFromFullname($person) {
	$personName = explode(' ', $person);
	$fullName = [
		'surname' => $personName[0],
		'name' => $personName[1], 
		'patronomyc' => $personName[2],
	];
	return $fullName;
};

function getFullnameFromParts ($surname, $name, $patronomyc){
    $FIO = "";
	$FIO .= $surname;
	$FIO .= " ";
	$FIO .= $name;
	$FIO .= " ";
	$FIO .= $patronomyc;
	return $FIO;
};


function getShortName($person){
	$shortname = "";
	$shortname .= getPartsFromFullname ($person) ['name'];
	$shortname .= " ";
	$shortname .= mb_substr(getPartsFromFullname($person)['surname'], 0, 1);
	$shortname .= ".";
	return $shortname;
};

function getGenderFromName($person){
	$gender = 0;
	$fullname = getPartsFromFullname($person);
	$searchName = mb_substr($fullname['name'], mb_strlen($fullname['name']) - 1);
	$searchSurnameFe = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 2);
	$searchSurnameMa = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 1);
	$searchPatronomycFe = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 3);
	$searchPatronomycMa = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 2);
	if (($searchName == 'й' || $searchName == 'н') || ($searchSurnameMa == 'в') || ($searchPatronomycMa == 'ич')) {
		$gender++;
	}else if (($searchName == 'а') || ($searchSurnameFe == 'ва') || ($searchPatronomycFe == 'вна')) {
		$gender--;
	}
	if($gender > 0){
		$printGender = "мужской пол";
	}elseif ($gender < 0) {
		$printGender = "женский пол";
	}else {
		$printGender = "неопределенный пол";
	}
	return $printGender;
};
?>

