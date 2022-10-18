<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Entity\Slider;
use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(AdminUrlGenerator $routebuilder)
    {
        $this->routeBuilder = $routebuilder;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(MembreCrudController::class)->generateUrl());
        // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('HotelHouse');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('HotelHouse'),
            MenuItem::linkToRoute('Retourner au site', 'fa fa-rotate-left', 'app_app'),
            MenuItem::section('Gestion'),
            MenuItem::linkToCrud('Membre', 'fa fa-user', Membre::class),
            MenuItem::linkToCrud('Slider', 'fas fa-images', Slider::class),
            MenuItem::linkToCrud('Chambre', 'fas fa-bed', Chambre::class),
            MenuItem::linkToCrud('Commande', 'fas fa-cash-register', Commande::class)
        ];  
    }
}
