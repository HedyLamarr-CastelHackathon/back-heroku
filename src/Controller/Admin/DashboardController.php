<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\Wish;
use App\Entity\Report;
use App\Entity\Garbage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Poubelles Manager');
    }

    public function configureMenuItems(): iterable
    {
       return [ 
            MenuItem::linktoDashboard('Accueil', 'fa fa-home'),
            MenuItem::linkToCrud('Poubelles', 'fa fa-trash', Garbage::class),
            MenuItem::linkToCrud('Types', 'fa fa-palette', Type::class),
            MenuItem::linkToCrud('Signalements', 'fa fa-warning', Report::class),
            MenuItem::linkToCrud('Souhaits', 'fa fa-clipboard', Wish::class),
        ];
    }
}
