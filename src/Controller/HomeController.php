<?php

namespace App\Controller;

use App\Entity\Campanias;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/')] //establecemos la pagina de inicio
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityPublicidad,EntityManagerInterface $entityGafas,EntityManagerInterface $entityLentillas): Response
    {
        $publicidad= $entityPublicidad->getRepository(Campanias::class)->findAll();
        $gafas= $entityGafas->getRepository(Gafas::class)->findAll();
        $lentillas= $entityLentillas->getRepository(Lentillas::class)->findAll();
        
        //dd($publicidad,$gafas,$lentillas);
        return $this->render('index.html.twig', [
            'controller_name' => 'Incio',
            'publicidad' => $publicidad,
            'gafas' => $gafas,
            'lentillas' => $lentillas
        ]);
    }


    //ESTA VISTA PODRIA APUNTAR AL CARRITO
    #[Route('/{id}/show/{cat}', name: 'app_show', methods: ['GET','POST'])]
    public function show( $id, $cat, EntityManagerInterface $producto )//: Response
    { 
        if($cat==1){
        $gafas=$producto->getRepository(Gafas::class)->findOneById($id);
        // return $this->render('show.html.twig', [
        //     'producto'=> $gafas 
        // ]);

        dd($gafas);
        }else if ($cat==2){

            $lentillas=$producto->getRepository(Lentillas::class)->findOneById($id);
            // return $this->render('show.html.twig', [
            //     'producto'=> $lentillas
            // ]);

        dd($lentillas);
        }
        
    }
}
