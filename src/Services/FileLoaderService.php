<?php

namespace Jurager\Exchange\Services;

use Jurager\Exchange\Config;
use LogicException;
use Symfony\Component\HttpFoundation\Request;
use ZipArchive;

/**
 * Class FileLoaderService.
 */
class FileLoaderService
{
    /**
     * @var Request
     */
    private Request $request;
    
    /**
     * @var Config
     */
    private Config $config;

    /**
     * FileLoaderService constructor.
     *
     * @param Request $request
     * @param Config  $config
     */
    public function __construct(Request $request, Config $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function load(): string
    {
        $filename = basename($this->request->get('filename'));
        $filePath = $this->config->getFullPath($filename);

        if ($filename === 'orders.xml') {
            throw new LogicException('This method is not released');
        }

        $directory = dirname($filePath);

        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }

        $f = fopen($filePath, 'wb+');

        fwrite($f, file_get_contents('php://input'));
        fclose($f);

        if ($this->config->isUseZip()) {

            $zip = new ZipArchive();

            $zip->open($filePath);
            $zip->extractTo($this->config->getImportDir());
            $zip->close();

            unlink($filePath);
        }

        return "success\n";
    }

    /**
     * Delete all files from tmp directory.
     */
    public function clearImportDirectory(): void
    {
        $tmp_files = glob($this->config->getImportDir() . DIRECTORY_SEPARATOR . '*.*', GLOB_NOSORT);

        if (is_array($tmp_files)) {
            foreach ($tmp_files as $v) {
                unlink($v);
            }
        }
    }
}
