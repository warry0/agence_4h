<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{

/**
 * @Route("/",name="home")
 * @param PropertyRepository $repo
 * @return Response
 */
    public function index(PropertyRepository $repo): Response
    {
        $propertises = $repo->findLatest();
        return $this->render('accueil/home.html.twig',[
            'propertises' => $propertises
        ]);
    }
}