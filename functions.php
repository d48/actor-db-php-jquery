<?php

/**
 * Determines if request was through ajax or not
 * @return boolean
 */
function isXHR() {
	return isset( $_SERVER['HTTP_X_REQUESTED_WITH']);
}

/**
 * Connect to our MySQL database with config info
 * @return [PDO] PDO object
 */
function connect() {
	global $pdo;
    $pdo = new PDO("mysql:host=int.instance27230.db.xeround.com:16122;dbname=sakila", "woot", "woot");
}

/**
 * Query databse to get actors by last name
 * @param  [string] $letter Letter of last name
 * @return [Array]  List of actors
 */
function get_actors_by_last_name( $letter ) {
	global $pdo;

	$stmt = $pdo->prepare('
		SELECT actor_id, first_name, last_name
		FROM actor
		WHERE last_name LIKE :letter
		LIMIT 50');

	$stmt->execute( array( ':letter' => $letter . '%' ) );

	return $stmt->fetchAll( PDO::FETCH_OBJ );
}

/**
 * Gets details of actor
 * @param  [Integer] $actor_id id in database
 * @return [Array]   Actor information
 */
function get_actor_info( $actor_id ) {
	global $pdo;

	$stmt = $pdo->prepare('
		SELECT film_info, first_name, last_name
		FROM actor_info
		WHERE actor_id LIKE :actor_id
		LIMIT 50');

	$stmt->execute( array( ':actor_id' => $actor_id ) );

	return $stmt->fetch( PDO::FETCH_OBJ );
}
