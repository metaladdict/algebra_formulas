<?php

/***********************************************************/
/******** 				VARIABLES et CONSTANTES 					********/
/***********************************************************/
$start = microtime(true);
$nmin = 1;
$nmax = 10;
$nbmb = 4;

$compteur = [
	'test'	=>	0,
	'valid'	=>	0,
];

$continuer_num = true;
$continuer_opr = true;
$membres = [
	'num' => [],
	'opr' => []
];

$sauvegarde = [];



/***********************************************************/
/******** 							EXECUTION ! 								********/
/***********************************************************/
//On initialise la liste des membres
for($i=0; $i<$nbmb; $i++)
{$membres['num'][] = $nmin;}

//On lance la boucle
while($continuer_num)
{
	//une combinaison de plus testée
	$compteur['test']++;

	//on garde la combinaison en mémoire pour affichage en fin de script
	$sauvegarde[] = implode(",", $membres['num']);

	//on incrémente le membres, la sortie définit si on continue de boucler sur le while
	$continuer_num = incrementer();
}

//Affichage du résultat
$temp = (microtime(true) - $start);
echo $compteur['test'].' combinaisons testées<br>';
echo 'en '.$temp.' s<br>';
echo '<pre>'.print_r($sauvegarde, true).'</pre>';




/***********************************************************/
/******** 								FONCTIONS									********/
/***********************************************************/
function incrementer()
{
	global $membres, $nmin, $nmax;

	for($i=sizeof($membres['num'])-1; $i>=0; $i--)
	{
		if($membres['num'][$i]<$nmax)
		{
			$membres['num'][$i]++; 
			return true;
		}
		else if($i>0)
		{
			$membres['num'][$i] = $nmin;
		}
		else
		{
			return false;
		}
	}
}

