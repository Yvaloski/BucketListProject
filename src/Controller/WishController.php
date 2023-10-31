<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_index")
     */
    public function index(): Response
    {
        return $this->render('wish/index.html.twig');
    }

    /**
     * @Route("/show", name="wish_show")
     */
    public function show(int $id):Response
    {
        //TODO: Récupérer la serie correspondante a $id
        return $this->render('wish/show.html.twig',[
            'id'=>$id

        ]);
    }
}
