<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $wishRepository): Response
    {
        $wishes=$wishRepository->findBy(['isPublished'=>true], ['dateCreated'=>'DESC']);
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'wishes'=>$wishes
        ]);
    }

    /**
     * @Route("/about-us",name="about_us")
     */
    public function about()

    {


        $json = file_get_contents($this->getParameter('kernel.project_dir').'/data/team.json');
        $jsonDecode = json_decode($json);



        return $this->render('main/about_us.html.twig',[
            'Json'=>$jsonDecode
        ]);
    }


}
