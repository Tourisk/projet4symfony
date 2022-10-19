<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/", name:"app_app")]
public function index(SliderRepository $repo)
{
    $photos=$repo->findAll();
    return $this->renderForm('app/index.html.twig', [
        'photos' => $photos
    ]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/reservation", name:"reservation")]
public function reservation(SliderRepository $repo, Commande $commande = null, EntityManagerInterface $manager, Request $request)
{
    $photos=$repo->findAll();
    if (!$commande) {
        $commande = new Commande;
        $commande->setDateEnregistrement(new \DateTime());
    }
    $form = $this->createForm(CommandeFormType::class, $commande);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $depart = $commande->getDateDepart();
        $arrivee = $commande->getDateArrivee();

        if ($arrivee->diff($commande->getDateDepart())->invert == 1) {
            $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
            return $this->redirectToRoute('reservation');
        }
        $days = $depart->diff($commande->getDateArrivee())->days;
        $prixTotal = ($commande->getChambre()->getPrixJournalier() * $days) + $commande->getChambre()->getPrixJournalier();
        $commande->setPrixTotal($prixTotal);
        $manager->persist($commande);
        $manager->flush();
        $this->addFlash('success', 'La réservation a bien été valider !');
        return $this->redirectToRoute('reservation');
    }
    return $this->renderForm('app/view/reservation.html.twig', [
        'commande' => $commande,
        'photos' => $photos,
        'form' => $form
    ]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/chambre", name:"chambre")]
public function chambre(ChambreRepository $repo_room, SliderRepository $repo)
{
    $photos=$repo->findAll();
    $repo_room=$repo_room->findAll();
    return $this->render('app/view/chambre.html.twig', [
        'photos' => $photos,
        'repo_room' => $repo_room

    ]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/restaurant", name:"restaurant")]
public function restaurant(SliderRepository $repo)
{
    $photos=$repo->findAll();
  return $this->renderForm('app/view/restaurant.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/spa", name:"spa")]
public function spa(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/spa.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/avis", name:"avis")]
public function avis(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/avis.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/hotel", name:"hotel")]
public function hotel(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/hotel.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/actualites", name:"actualites")]
public function actualites(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/actualites.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/contact", name:"contact")]
public function contact(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/contact.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/cgu", name:"cgu")]
public function cgu(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/cgu.html.twig', [
    'photos' => $photos
]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route("/legal", name:"legal")]
public function legal(SliderRepository $repo)
{    
    $photos=$repo->findAll();
  return $this->renderForm('app/view/legal.html.twig', [
    'photos' => $photos
]);
}

}
