# Jurager/Exchange
[![Latest Stable Version](https://poser.pugx.org/jurager/exchange/v/stable)](https://packagist.org/packages/jurager/exchange)
[![Total Downloads](https://poser.pugx.org/jurager/exchange/downloads)](https://packagist.org/packages/jurager/exchange)
[![License](https://poser.pugx.org/jurager/exchange/license)](https://packagist.org/packages/jurager/exchange)

Пакет признан облегчить интеграцию 1С предприятия и сайта на Laravel. 

## Установка
```
composer require jurager/exchange
```
 
### Опубликовать конфигурацию
```
php artisan vendor:publish --provider="Jurager\Exchange\ExchangeServiceProvider"
```
 
## Использование
В конфигурации необходимо указать, логин, пароль, свои модели и реализовать интерфейсы
```php
\Jurager\Exchange1C\Interfaces\GroupInterface::class   => \App\Models\Category::class,
\Jurager\Exchange1C\Interfaces\ProductInterface::class => \App\Models\Product::class,
\Jurager\Exchange1C\Interfaces\OfferInterface::class   => \App\Models\Offer::class,
```

Методы, которые необходимо реализовать можно прочитать в документации к модулю [carono/yii2-1c-exchange]((https://github.com/carono/yii2-1c-exchange#%D0%98%D0%BD%D1%82%D0%B5%D1%80%D1%84%D0%B5%D0%B9%D1%81%D1%8B))

Далее необходимо [настроить](https://github.com/carono/yii2-1c-exchange#%D0%9D%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%BA%D0%B0-1%D0%A1) 1С:Предприятие

### Подписка на события
Вы можете подписаться на любое событие вызываемое внутри пакета [jurager/exchange](https://github.com/jurager/exchange/tree/master/src/Events) 
```php
'Jurager\Exchange\Events\BeforeOffersSync' => [
    'App\Listeners\BeforeOffersSyncListener',
],
```

# Лицензия
Данный пакет является открытым кодом под лицензией [MIT license](LICENSE).
