<?php
require 'vendor/autoload.php';
require 'database/ConectionFactory.php';
require 'tasks/Service.php';

$app = new \Slim\Slim();

$app->get('/guest', function() use ($app){
    $db = ConectionFactory::getDB();
    
    $guests = array();
    foreach($db->guests() as $guests){
        $guests[] = array(
            'id' => $guest["id"],
            'name' => $guest['name'], 
            'email' => $guest['email']
        );
    }
    
    $app->response()->header('Content-Type','application/json');
    echo json_encode($guests);
});

$app->post('/guest', function () use ( $app ) {
	$db = ConectionFactory::getDB();
	
	$guestToAdd = json_decode($app->request->getBody(), true);
	$guest = $db->guests->insert($guestToAdd);
	
	$app->response->header('Content-Type', 'application/json');
	echo json_encode($guest);
});

$app->delete('/guest/:nome', function($nome) use ( $app ) { 
	$db = ConectionFactory::getDB();
	$response = "";
	
	$guest = $db->guests()->where('nome', $nome);
	
	if($guest->fetch()) {
		$result = $guest->delete();
		$response = array(
			'status' => 'true',
			'message' => 'Guest deleted!'
		);
	}
	else {
		$response = array(
			'status' => 'false',
			'message' => 'Guest with $id does not exit'
		);
		$app->response->setStatus(404);
	}
	
	$app->response()->header('Content-Type', 'application/json');
	echo json_encode($response);
});



?>