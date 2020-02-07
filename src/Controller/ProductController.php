<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function all(ProductRepository $productRepository)
    {
        $Repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $Repository->findAll();

        $date = $productRepository->findByDerDate();

        return $this->render('product/produit.html.twig', [
            'products'=>$products,
            'date'=>$date,
        ]);
    }

    /**
     * @Route ("/product/{slug}", name="product_show")
     */
    public function show($slug)
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        /**
         * @var Product $product
         */
        $product = $productRepository->findOneBySlug($slug);

        if (!$product){
            throw $this->createNotFoundException('Le produit n\'existe pas');
        }

        return $this->render('product/productShow.html.twig',[
            'product' => $product,
        ]);
    }
}
