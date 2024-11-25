<?php

namespace App\Controller;

use App\Entity\Campanias;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
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

         // buscamos los logos de las marcas en el directorio public/images/marcas
         $marcasDir = $this->getParameter('kernel.project_dir') . '/public/images/marcas';
         $finder = new Finder();
         $finder->files()->in($marcasDir)->name('/\.(jpg|jpeg|png|gif)$/i');
 
         $marcas = [];
         foreach ($finder as $file) {
             $marcas[] = $file->getRelativePathname();
         }
        
        //dd($publicidad,$gafas,$lentillas);
        return $this->render('index.html.twig', [
            'controller_name' => 'inicio',
            'publicidad' => $publicidad,
            'gafas' => $gafas,
            'lentillas' => $lentillas,
            'marcas' => $marcas,
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
