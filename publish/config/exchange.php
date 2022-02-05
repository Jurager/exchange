<?php

use Illuminate\Support\Str;

return [
    'path'                 => 'exchange',
    'session_name'         => Str::slug( config('app.name', 'laravel'), '_').'_session',
    'import_dir'           => storage_path('app/exchange'),
    'login'                => 'admin',
    'password'             => 'admin',
    'use_zip'              => false,
    'file_part'             => 0,
    'product_limit'        => 150,
    'product_import_delay' => 4,

    'models' => [
        \Jurager\Exchange\Interfaces\WarehouseInterface::class => \App\Models\ProductWarehouse::class,
        \Jurager\Exchange\Interfaces\GroupInterface::class     => \App\Models\ProductGroup::class,
        \Jurager\Exchange\Interfaces\ProductInterface::class   => \App\Models\Product::class,
        \Jurager\Exchange\Interfaces\PriceTypeInterface::class => \App\Models\ProductPrice::class,
        \Jurager\Exchange\Interfaces\OfferInterface::class     => \App\Models\Product::class,
    ],

    'services'=> [
        \Jurager\Exchange\Services\AuthService::class => \App\Services\Commerce\AuthService::class,
    ],
];
