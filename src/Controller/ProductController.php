<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\ExchangeRate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function show(Product $product, ExchangeRate $exchangeRate): Response
    {
        //TODO : Convert price of the product into dollar and yen, and send it to the twig template
        $dollarPrice = $exchangeRate->convertEurToDollar($product->getPrice());

        return $this->render('product/details.html.twig', [
            'product' => $product,
            'dollar_price' => 0,
            'yen_price' => 0,
        ]);
    }
}