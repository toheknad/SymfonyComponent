<?php

namespace App\System\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface IController {

    public function render (array $response): JsonResponse;
}