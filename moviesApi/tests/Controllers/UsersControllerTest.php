<?php

namespace App\Tests\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase {
//	public function testUserCreation() {
//		$client = static::createClient();
//
//		$client->setServerParameters([]);
//		$client->request(
//			'POST',
//			'/api/users',
//			[],
//			[],
//			['CONTENT_TYPE' => 'application/json'],
//			'{"name":"TestUser", "birthDate":"2000-10-10", "email":"vardas0@gmail.com", "password":"test"}'
//		);
//
//		$this->assertEquals(200, $client->getResponse()->getStatusCode());
//		$this->assertIsString(json_decode($client->getResponse()->getContent()));
//	}

	public function testUserMovies() {
		$client = static::createClient();

		$client->setServerParameters([]);
		$client->request(
			'GET',
			'/api/users/5/movies'
		);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$this->assertIsArray(json_decode($client->getResponse()->getContent()));
	}
}