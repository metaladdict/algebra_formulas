<?php

/***********************************************************/
/******** 				VARIABLES et CONSTANTES 					********/
/***********************************************************/
$start = microtime(true);
$nmin = 1;
$nmax = 10;
$nbmb = 4;
$operateurs = ['+','-','*','/'];

$compteur = [
	'test'	=>	0,
	'valid'	=>	0,
];

$continuer_num = true;
$membres = [
	'num' => [],
	'opr' => []
];

$sauvegarde = [];



/***********************************************************/
/******** 							EXECUTION ! 								********/
/***********************************************************/
//On initialise la liste des membres et des opérateurs
for($i=0; $i<$nbmb; $i++)
{$membres['num'][] = $nmin;}
for($i=0; $i<$nbmb-1; $i++)
{$membres['opr'][] = 0;}

//On lance la boucle
while($continuer_num)
{
	//on redéfinit la boucle opérateur sur TRUE
	$continuer_opr = true;
	while($continuer_opr)
	{
		//une combinaison de plus testée
		$compteur['test']++;

		//on garde la combinaison en mémoire pour affichage en fin de script
		$sauvegarde[] = implode(",", $membres['num']).'/'.implode(",", $membres['opr']);

		//on incrémente les opérateurs
		$continuer_opr = incrementer('opr', true);
	}

	//on incrémente les membres numérique
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
function incrementer($typ='num', $boucler=false)
{
	global $membres, $nmin, $nmax, $operateurs;
	//Définition des valeur minimale et maximale selon le type d'opérateur à incrémenter
	$min = ($typ=='opr') ? 0 : $nmin;
	$max = ($typ=='opr') ? sizeof($operateurs)-1 : $nmax;

	for($i=sizeof($membres[$typ])-1; $i>=0; $i--)
	{
		if($membres[$typ][$i]<$max)
		{
			$membres[$typ][$i]++; 
			return true;
		}
		else if($i>0)
		{
			$membres[$typ][$i] = $min;
		}
		else
		{
			if($boucler)
			{
				//si c'est un membre sur lequel on doit reboucler, on réinitialise
				foreach($membres[$typ] as $k=>$v)
				{$membres[$typ][$k] = $min;}
			}
			
			return false;
		}
	}
}

