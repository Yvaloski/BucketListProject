<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/wish")
 *
 */
class WishController extends AbstractController
{
    /**
     * @Route("/", name="wish_index")
     */
    public function index(WishRepository $wishRepository): Response
    {
        $user = $this->getUser();
        // on peut utiliser le EntityManagerInterface pour recupérer le repositorie aussi

        $wishes = $wishRepository->findBy(['user' => $user], ['dateCreated' => 'DESC']);
        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes
        ]);
    }

    /**
     * @Route("/{id}", name="wish_show",requirements={"id"="\d+"})
     */
    public function show(WishRepository $wishRepository, int $id): Response
    {
        // Récupérer le souhait correspondante a $id
        $wish = $wishRepository->find($id);
        if ($wish == null) {
            throw $this->createNotFoundException("Ce souhait n'existe pas ");
        }


        return $this->render('wish/show.html.twig', [
            'wish' => $wish

        ]);
    }

    /**
     * @Route("/new", name="wish_new")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $wish->setUser($this->getUser());
        $wish->setDateCreated(new \DateTime());
        $wish->setIsPublished(true);
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {

            $manager->persist($wish);
            $manager->flush();

            $this->addFlash('succes', 'Votre souhait a bien été enregistrée !');


            return $this->redirectToRoute('wish_show', [
                'id' => $wish->getId()
            ]);

        }

        return $this->render('wish/new.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wish_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Wish $wish, EntityManagerInterface $manager, WishRepository $wishRepository): Response
    {
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $wish->setUser($this->getUser());
        $wish->setDateCreated(new \DateTime());
        $wish->setIsPublished(true);
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {

            $manager->persist($wish);
            $manager->flush();

            $this->addFlash('succes', 'Votre souhait a bien été enregistrée !');

            return $this->redirectToRoute('wish_show', [
                'id' => $wish->getId()

            ]);
        }

            return $this->renderForm('wish/edit.html.twig', [
                'category' => $wish,
                'wishForm' => $wishForm]);
        }



}