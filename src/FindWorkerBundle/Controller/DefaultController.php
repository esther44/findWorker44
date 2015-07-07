<?php

namespace FindWorkerBundle\Controller;

require_once '../vendor/autoload.php';

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Github\Api\ApiInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$client = new \Github\Client();
		
		$client->setOption('api_limit', 60);

		//ne récupère que les 30 premiers résultats; comment récupérer les 311540 (en entier) ?
		$profils = $client->api('search')->users('language:php');

		foreach($profils["items"] as $key => $value) {
			//get infos' user
			$username = $value["login"];
			$user = $client->api('user')->show($username);
			var_dump($user);
		}

        return $this->render('FindWorkerBundle:Default:index.html.twig');
    }

    /* method ne marche pas : Attempted to call function "findInfoByUser" from namespace "FindWorkerBundle\Controller".
    public function findInfoByUser($username) {
		//get infos' user
		$user = $client->api('user')->show($username);
		var_dump($user);
		
		//print $user['login'];
		//print $user['email'];
		//print $user['following'];
		//print $user['public_repos'];
	
    }*/
}