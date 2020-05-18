<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/test", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }



    /**
     * @Route("/nos-produits", name="list_products")
     */
    public function listProduct()
    {
        return $this->render('product/index.html.twig');
    }




    /**
     * @Route("/article/{slug}/{id}", name="detail_product")
     */
    public function showProduct(string $slug, Product $product)
    {
       // dd($product);
        return $this->render('product/show.html.twig',compact('product'));
    }
    
}
