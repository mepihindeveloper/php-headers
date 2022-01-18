<?php

use Codeception\Test\Unit;
use mepihindeveloper\components\Headers;

class HeadersTest extends Unit {
	
	/**
	 * @var UnitTester
	 */
	protected $tester;
	protected ?Headers $headers;
	protected array $data = ['Content-type' => 'text/plain'];
	protected $serverData;
	
	public function testGetAll() {
		$this->assertIsArray($this->headers->getAll());
	}
	
	public function testAdd() {
		$this->headers->add($this->data);
		$this->assertArrayHasKey('Content-type', $this->headers->getAll());
	}
	
	public function testRemove() {
		$this->headers->remove('Content-type');
		$this->assertArrayNotHasKey('Content-type', $this->headers->getAll());
	}
	
	public function testRemoveAll() {
		$this->headers->removeAll();
		$this->assertEmpty($this->headers->getAll());
	}
	
	public function testHas() {
		$this->assertFalse($this->headers->has('Content-type'));
	}
	
	public function testGet() {
		$this->headers->add($this->data);
		$this->assertNotEmpty($this->headers->get('Content-type'));
	}
	
	public function testGetWithException() {
		$this->expectException(InvalidArgumentException::class);
		$this->headers->get('Content-type');
	}
	
	public function testGetAllHeadersWithApacheMode() {
		$this->headers = $this->make(Headers::class, [
			'isApache' => true,
		]);
		$this->assertIsArray($this->headers->getAllHeaders());
	}
	
	public function testGetIsApache() {
		$this->assertIsBool($this->headers->getIsApache());
	}
	
	public function testGetAllHeadersWithHttpHeaders() {
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'Codeception Tests';
		$this->headers = $this->make(Headers::class, [
			'isApache' => false,
		]);
		$this->assertNotEmpty($this->headers->getAllHeaders());
	}
	
	public function testGetAllHeadersWithNotArrayServer() {
		$_SERVER = false;
		$this->headers = $this->make(Headers::class, [
			'isApache' => false,
		]);
		$this->assertEmpty($this->headers->getAllHeaders());
	}
	
	protected function _before() {
		$this->headers = new Headers();
	}
	
	// tests

	protected function _after() {
		$this->headers = null;
	}
}