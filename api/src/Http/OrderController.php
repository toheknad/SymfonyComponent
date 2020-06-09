<?php


namespace App\Http;


use App\Entities\Order;
use App\Services\CreateOrderService;
use App\Services\GenerateProductService;
use App\Services\PaymentOrderAction;
use App\Services\PaymentOrderService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class OrderController extends Controller
{
    private $request;

    private $createOrderService;
    private $paymentOrderService;

    /**
     * OrderController constructor.
     * @param RequestStack $request
     * @param CreateOrderService $createOrderService
     * @param PaymentOrderService $paymentOrderService
     */
    public function __construct(RequestStack $request, CreateOrderService $createOrderService, PaymentOrderService $paymentOrderService)
    {
        $this->request = $request->getCurrentRequest();
        $this->createOrderService = $createOrderService;
        $this->paymentOrderService = $paymentOrderService;
    }

    /**
     * @return JsonResponse
     */
    public function createAction()
    {
        $productIds = array_values(json_decode($this->request->getContent(), true)['ids']);
        if (!empty($order = $this->createOrderService->create((array)$productIds))) {
            return $this->render(['answer'=>'Order added: '. $order]);
        } else {
            return $this->render(['answer'=>"Fail!"]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function paymentAction(){
        $params = json_decode($this->request->getContent(), true);
        if ($this->paymentOrderService->payment($params['id'], $params['price'])) {
            return $this->render(['answer'=>'Payment succesefull!']);
        } else {
            return $this->render(['answer'=>"Fail!"]);
        }
    }

}