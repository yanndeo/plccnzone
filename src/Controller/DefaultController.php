<?php

namespace App\Controller;

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
     * @Route("/nos-produits", name="products")
     */
    public function listProduct()
    {
        return $this->render('product/index.html.twig');
    }
}
