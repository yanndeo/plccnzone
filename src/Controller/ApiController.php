<?php

namespace App\Controller;

use UnexpectedValueException;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiController extends AbstractController
{

   
    private $categoryRepository;

    private $productRepository;
    

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository; 
    }




    /**
     * @Route("/api/default-data/{page<\d+>?1}", name="api_default_data", methods= {"GET"})
     */
    public function index( Request $request, NormalizerInterface $normalizerInterface)
    {

        $page = $request->query->get('page');
        $limit = 10;
        if (is_null($page) || $page < 1) {
            $page = 1;
        }

        // $products = $this->productRepository->findAllPb($page, $limit);
        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        //Normalization + Encodage
        /*
        $productsNormalizes = $normalizerInterface->normalize($products,null, ['groups'=> 'product:read']);
        $json = json_encode($productsNormalizes);*/

        try{

            //$products = $serializerInterface->serialize($products, 'json', ['groups' => 'product:read']);
            //$categories = $serializerInterface->serialize($categories, 'json', ['groups' => 'category:read']);
            //$res = new JsonResponse($products, 200, [], false);

            $productsNormalizes = $normalizerInterface->normalize($products,null, ['groups'=> 'product:read']);
            $categoriesNormalizes = $normalizerInterface->normalize($categories,null, ['groups'=> 'category:read'] );
            
            $res = new Response();
            $res->setContent(json_encode([
                'products' => $productsNormalizes,
                'categories'=> $categoriesNormalizes,
                'fabricants' => ''
            ]));
            $res->headers->set('Content-Type', 'application/json');


        }catch(NotEncodableValueException $e){

            $res = new JsonResponse(['message'=> $e->getMessage(), 'status'=> 400], 400, [], false);
        } catch (UnexpectedValueException $e) {
            $res = new JsonResponse(['message' => $e->getMessage(), 'status' => 400], 400, [], false);

        }


        return $res;
    }
}
