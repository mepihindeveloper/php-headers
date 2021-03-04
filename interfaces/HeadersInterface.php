<?php
declare(strict_types = 1);

/**
 * Интерфейс HeadersInterface
 *
 * Декларирует методы обязательные для реализации компонента Headers
 */
interface HeadersInterface {
	
	/**
	 * Устанавливает заголовок(и)
	 *
	 * @param array $params Заголовок(и) [key => value]
	 *
	 * @return void
	 */
	public function set(array $params): void;
	
	/**
	 * Добавляет заголовок. Если заголовок уже существует, то он будет перезаписан.
	 *
	 * @param array $params Заголовки [key => value]
	 *
	 * @return void
	 */
	public function add(array $params): void;
	
	/**
	 * Удаляет заголовок
	 *
	 * @param string $key Заголовок
	 *
	 * @return void
	 */
	public function remove(string $key): void;
	
	/**
	 * Удаляет все заголовки
	 *
	 * @return void
	 */
	public function removeAll(): void;
	
	/**
	 * Проверяет наличие заголовка. Проверка идет на наличие ключа и значения
	 *
	 * @param string $key Заголовок
	 *
	 * @return bool
	 */
	public function has(string $key): bool;
	
	/**
	 * Получает значение заголовка
	 *
	 * @param string $key Заголовок
	 *
	 * @return string
	 *
	 * @throws InvalidArgumentException
	 */
	public function get(string $key): string;
	
	/**
	 * Получает все заголовки
	 *
	 * @return array
	 */
	public function getAll(): array;
}