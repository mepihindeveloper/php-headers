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
	
	public const APACHE = 'Apache';
	
	/**
	 * @var array Заголовки
	 */
	private array $headers;
	/**
	 * @var bool Является ли сервер Apache
	 */
	private bool $isApache;
	
	public function __construct() {
		$this->isApache = array_key_exists('SERVER_SOFTWARE', $_SERVER) && $_SERVER['SERVER_SOFTWARE'] === self::APACHE;
		$this->headers = $this->getAllHeaders();
	}
	
	/**
	 * Возвращает, является ли сервер Apache
	 *
	 * @return bool
	 */
	public function getIsApache():bool {
		return $this->isApache;
	}
	
	/**
	 * Получает все заголовки методами apache и nginx
	 *
	 * @return array
	 */
	public function getAllHeaders(): array {
		if ($this->isApache && function_exists('getallheaders')) {
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
	public function getAll(): array {
		return $this->headers;
	}
	
	/**
	 * @inheritDoc
	 */
	public function add(array $params): void {
		foreach ($params as $header => $value) {
			$headerExists = array_key_exists($header, $this->headers);
			$this->headers[$header] = $value;
			
			header("$header: $value", $headerExists);
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function remove(string $key): void {
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
		return array_key_exists($key, $this->headers);
	}
}
