<?php

namespace Jurager\Exchange\Controller;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Jurager\Exchange\Exceptions\ExchangeException;
use Jurager\Exchange\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use LogicException;

/**
 * Class ImportController.
 */
class ImportController extends Controller
{
    /**
     * @param Request $request
     * @param CatalogService $service
     *
     * @return ResponseFactory|Response
     * @throws ExchangeException
     */
    public function request(Request $request, CatalogService $service)
    {
        $mode = $request->get('mode');
        $type = $request->get('type');

        try {
            if ($type === 'catalog') {

                if (!method_exists($service, $mode)) {
                    throw new ExchangeException('Not correct request, class not found');
                }

                return response($service->$mode(), 200, ['Content-Type', 'text/plain']);
            }

            throw new LogicException(sprintf('Logic for method %s is not released', $type));

        } catch (ExchangeException $e) {

            Log::error("exchange: failure \n".$e->getMessage()."\n".$e->getFile()."\n".$e->getLine()."\n");

            $response = "failure\n";
            $response .= iconv('utf-8', 'windows-1251', $e->getMessage());

            return response($response, 500, ['Content-Type', 'text/plain']);
        }
    }
}
