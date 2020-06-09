<?php


namespace App\Http;


use App\Services\CreateOrderService;
use App\Services\GenerateProductService;
use App\Services\TestService;
use App\Entities\Product;
use App\Repository\ProductRepository;
use App\System\Datebase\DoctrineManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProductController extends Controller
{
    const COUNT = 20;

    private $request;

    private $generateProductService;
    private $createProductService;

    /**
     * ProductController constructor.
     * @param RequestStack $request
     * @param GenerateProductService $generateProductService
     * @param CreateOrderService $createProductService
     */
    public function __construct(RequestStack $request, GenerateProductService $generateProductService, CreateOrderService $createProductService)
    {
        $this->request = $request->getCurrentRequest();
        $this->generateProductService = $generateProductService;
        $this->createProductService = $createProductService;
    }

    /**
     * @return JsonResponse
     */
    public function generateAction(): JsonResponse
    {
        $this->generateProductService->generate(self::COUNT);

        return $this->render(['answer'=>"Products added: ".self::COUNT]);
    }

}