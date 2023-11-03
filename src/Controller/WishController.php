<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/wish")
 */
class WishController extends AbstractController
{
    /**
     * @Route("/", name="wish_index")
     */
    public function index(WishRepository $wishRepository): Response
    {
        // on peut utiliser le EntityManagerInterface pour recupérer le repositorie aussi

        $wishes=$wishRepository->findBy(['isPublished'=>true], ['dateCreated'=>'DESC']);
        return $this->render('wish/index.html.twig',[
            'wishes'=>$wishes
        ]);
    }

    /**
     * @Route("/{id}", name="wish_show",requirements={"id"="\d+"})
     */
    public function show(WishRepository $wishRepository,int $id):Response
    {
        // Récupérer le souhait correspondante a $id
        $wish = $wishRepository->find($id);
        if ($wish == null) {
            throw $this->createNotFoundException("Ce souhait n'existe pas ");
        }


        return $this->render('wish/show.html.twig',[
            'wish' => $wish

        ]);
    }
}
