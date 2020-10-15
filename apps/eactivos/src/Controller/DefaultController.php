<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/" ,name="homepage")
     */
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('index.html.twig',[]);
    }
}

