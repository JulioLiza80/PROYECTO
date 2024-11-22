<?php

namespace App\Controller\Admin;

use App\Entity\Campanias;
use App\Entity\DetalleCompra;
use App\Entity\DetallePedido;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use App\Entity\Pedidos;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Optica Nova');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Optica Nova', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Gafas', 'fas fa-list', Gafas::class);
        yield MenuItem::linkToCrud('Lentillas', 'fas fa-list', Lentillas::class);
        yield MenuItem::linkToCrud('campañas', 'fas fa-list', Campanias::class);
        yield MenuItem::linkToCrud('Detalle Compra', 'fas fa-list', DetalleCompra::class);
        yield MenuItem::linkToCrud('Pedidos', 'fas fa-list', Pedidos::class);
        yield MenuItem::linkToCrud('Detalle Pedidos', 'fas fa-list', DetallePedido::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
