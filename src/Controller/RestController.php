<?php
namespace App\Controller;


use App\Service\calculateAreaService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Rest Controller.
 * @Rest\Route("/api",name="api_")
 */

class RestController extends AbstractFOSRestController
{
    /**
     * @var calculateAreaService
     */
    private $calculateAreaService;


    /**
     * RestController constructor.
     * @param calculateAreaService $calculateAreaService
     */
    public function __construct(calculateAreaService $calculateAreaService)
    {
        $this->calculateAreaService = $calculateAreaService;
    }

    /**
     * @Rest\Get("/triangle/{a}/{b}/{c}")
     * @param $a
     * @param $b
     * @param $c
     * @return JsonResponse
     */
    public function triangleAction($a, $b, $c):JsonResponse
    {
        try {
            $triangleSurface = $this->calculateAreaService->triangleSurface($a, $b, $c);

            return new JsonResponse($triangleSurface);
        } catch (\Exception $exception) {
            $error = array(
                'error' => array(
                    'msg' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ),
            );
            return new JsonResponse($error);
        }

    }

    /**
     * @Rest\Get("/circle/{radius}")
     * @param $radius
     * @return JsonResponse
     */
    public function circleAction($radius):JsonResponse
    {
        try {
            $circleSurface = $this->calculateAreaService->circleSurface($radius);

            return new JsonResponse($circleSurface);
        } catch (\Exception $exception) {
            $error = array(
                'error' => array(
                    'msg' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ),
            );
            return new JsonResponse($error);
        }

    }
}