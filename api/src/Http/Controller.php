<?php

namespace App\Http;

use App\System\Controller\IController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller implements IController
{

    /**
     * @param array $response
     * @return JsonResponse
     */
    public function render(array $response): JsonResponse
    {
        return new JsonResponse($response);
    }
}