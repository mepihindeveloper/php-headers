<?php

declare(strict_types = 1);

namespace mepihindeveloper\components;

use InvalidArgumentException;
use mepihindeveloper\components\interfaces\HeadersInterface;

/**
 * Класс Headers
 *
 * Реализует управление заголовками запроса
 */
class Headers implements HeadersInterface {
	
	/**
	 * @var array Заголовки
	 */
	private array $headers;
	
	public function __construct() {
		$this->headers = $this->getAllHeaders();
	}
	
	/**
	 * Получает все заголовки методами apache и nginx
	 *
	 * @return array
	 */
	private function getAllHeaders(): array {
		if (function_exists('getallheaders')) {
			return getallheaders() !== false ? getallheaders() : [];
		}
		
		if (!is_array($_SERVER)) {
			return [];
		}
		
		$headers = [];
		
		foreach ($_SERVER as $name => $value) {
			if (strpos($name, 'HTTP_') === 0) {
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}
		
		return $headers;
	}
	
	/**
	 * @inheritDoc
	 */
	public function set(array $params): void {
		$this->getAll();
		
		foreach ($params as $header => $value) {
			$this->headers[$header] = $value;
		}
		
		$this->add($params);
	}
	
	/**
	 * @inheritDoc
	 */
	public function getAll(): array {
		$this->headers = !empty($this->headers) ? $this->headers : $this->getAllHeaders();
		
		return $this->headers;
	}
	
	/**
	 * @inheritDoc
	 */
	public function add(array $params): void {
		foreach ($params as $header => $value) {
			$headerExists = array_key_exists($header, $this->headers);
			$this->headers[$header] = $value;
			
			header("{$header}: {$value}", $headerExists);
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function remove(string $key): void {
		$this->getAll();
		
		unset($this->headers[$key]);
		header_remove($key);
	}
	
	/**
	 * @inheritDoc
	 */
	public function removeAll(): void {
		$this->headers = [];
		
		header_remove();
	}
	
	/**
	 * @inheritDoc
	 */
	public function get(string $key): string {
		if (!$this->has($key)) {
			throw new InvalidArgumentException("Заголовок {$key} отсутствует.");
		}
		
		return $this->headers[$key];
	}
	
	/**
	 * @inheritDoc
	 */
	public function has(string $key): bool {
		$this->getAll();
		
		return array_key_exists($key, $this->headers);
	}
}
