# php-headers

![release](https://img.shields.io/github/v/release/mepihindeveloper/php-headers?label=version)
[![Packagist Version](https://img.shields.io/packagist/v/mepihindeveloper/php-headers)](https://packagist.org/packages/mepihindeveloper/php-headers)
[![PHP Version Require](http://poser.pugx.org/mepihindeveloper/php-headers/require/php)](https://packagist.org/packages/mepihindeveloper/php-headers)
![license](https://img.shields.io/github/license/mepihindeveloper/php-headers)

![build](https://github.com/mepihindeveloper/php-headers/actions/workflows/php.yml/badge.svg?branch=stable)
[![codecov](https://codecov.io/gh/mepihindeveloper/php-headers/branch/stable/graph/badge.svg?token=36PP7VKHKG)](https://codecov.io/gh/mepihindeveloper/php-headers)


Компонент для работы с заголовками в PHP

# Структура

```
src/
--- interfaces/
--- Headers.php
```

В директории `interfaces` хранятся необходимые интерфейсы, которые необходимо имплементировать в при реализации
собственного класса `Headers`.

Класс `Headers` реализует интерфейс `HeadersInterface` для управления заголовками.

# Доступные методы

| Метод               | Аргументы                   | Возвращаемые данные | Исключения               | Описание                                                                    |
|---------------------|-----------------------------|---------------------|--------------------------|-----------------------------------------------------------------------------|
| add(array $params)  | Заголовок(и) [key => value] | void                |                          | Добавляет заголовок. Если заголовок уже существует, то он будет перезаписан |
| remove(string $key) | Заголовок                   | void                |                          | Удаляет заголовок                                                           |
| removeAll           |                             | void                |                          | Удаляет все заголовки                                                       |
| has(string $key)    | Заголовок                   | bool                |                          | Проверяет наличие заголовка. Проверка идет на наличие ключа и значения      |
| get(string $key)    | Заголовок                   | string              | InvalidArgumentException | Получает значение заголовка                                                 |
| getAll              |                             |                     |                          | Получает все заголовки                                                      |
| getIsApache         |                             | bool                |                          | Возвращает, является ли сервер Apache                                       |

# Контакты

Вы можете связаться со мной в социальной сети ВКонтакте: [ВКонтакте: Максим Епихин](https://vk.com/maximepihin)

Если удобно писать на почту, то можете воспользоваться этим адресом: mepihindeveloper@gmail.com

Мой канал на YouTube, который посвящен разработке веб и игровых
проектов: [YouTube: Максим Епихин](https://www.youtube.com/channel/UCKusRcoHUy6T4sei-rVzCqQ)

Поддержать меня можно переводом на Яндекс.Деньги: [Денежный перевод](https://yoomoney.ru/to/410012382226565)
