<?php

namespace Jurager\Exchange;

/**
 * Class Config.
 */
class Config
{
    /**
     * @var string
     */
    private string $importDir = 'import_dir';

    /**
     * @var string
     */
    private string $sessionName = 'laravel_session';

    /**
     * @var string
     */
    private string $login = 'admin';

    /**
     * @var string
     */
    private string $password = 'admin';

    /**
     * @var bool
     */
    private bool $useZip = false;

    /**
     * @var int
     */
    private int $filePart = 0;

    /**
     * @var array
     */
    private array $models = [
        \Jurager\Exchange\Interfaces\GroupInterface::class   => null,
        \Jurager\Exchange\Interfaces\ProductInterface::class => null,
        \Jurager\Exchange\Interfaces\OfferInterface::class   => null,
        \Jurager\Exchange\Interfaces\PriceTypeInterface::class   => null,
    ];

    private array $services = [
        \Jurager\Exchange\Services\AuthService::class => null,
    ];

    /**
     * @var int|null
     */
    private int|null $merchant_id;

    /**
     * Config constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->configure($config);
    }

    /**
     * Overrides default configuration settings.
     *
     * @param array $config
     */
    private function configure(array $config = []): void
    {
        foreach ($config as $param => $value) {

            $property = $this->toCamelCase($param);

            if (property_exists(self::class, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getImportDir(): string
    {
        return $this->merchant_id ? $this->importDir.DIRECTORY_SEPARATOR.$this->merchant_id : $this->importDir ;
    }

    /**
     * @return string
     */
    public function getSessionName(): string
    {
        return $this->sessionName;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }
    
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isUseZip(): bool
    {
        return $this->useZip;
    }

    /**
     * @return int
     */
    public function getFilePart(): int
    {
        return $this->filePart;
    }

    /**
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * @param string $modelName
     *
     * @return null|string
     */
    public function getModelClass(string $modelName): ?string
    {
        return $this->models[$modelName] ?? null;
    }

    public function getServiceClass(string $serviceName): ?string
    {
        return $this->services[$serviceName] ?? null;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function getFullPath(string $filename): string
    {
        return $this->getImportDir().DIRECTORY_SEPARATOR.$filename;
    }

    /**
     * Translates a string with underscores into camel case (e.g. first_name -&gt; firstName).
     *
     * @param string $str String in underscore format
     *
     * @return string $str translated into camel caps
     */
    private function toCamelCase(string $str): string
    {
        $func = static function ($c) {
            return strtoupper($c[1]);
        };

        return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    /**
     * @param int $merchant_id
     *
     * @return void
     */
    public function setMerchant($merchant_id)
    {
        $this->merchant_id = (string) $merchant_id;
    }

    /**
     * @return string|null
     */
    public function getMerchant() : ?string
    {
        return $this->merchant_id;
    }
}
