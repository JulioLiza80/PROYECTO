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
        if(isset($_GET['error']) && str_contains($_GET['error'],' Todavía no has verificado tu cuenta.')){
            return $this->redirectToRoute('app_request_verify_email');
        }else{
        $publicidad= $entityPublicidad->getRepository(Campanias::class)->findAll();
        $gafas= $entityGafas->getRepository(Gafas::class)->findAll();
        $lentillas= $entityLentillas->getRepository(Lentillas::class)->findAll();

        // Combinar y filtrar las gafas y lentillas con destacado = 1
        $destacados = array_filter(array_merge($gafas, $lentillas), function ($item) {
            return $item->getDestacado() === 1;
        });

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
            'destacados' => $destacados,
        ]);
    } 
    }

    #[Route('/aviso-legal', name: 'app_aviso_legal', methods: ['GET'])]
    public function avisoLegal(EntityManagerInterface $entityManager): Response
    {
        return $this->render('legal/aviso_legal.html.twig', []);
    }

    #[Route('/politica-de-envio', name: 'app_politica_envio', methods: ['GET'])]
    public function politicaEnvio(EntityManagerInterface $entityManager): Response
    {
        return $this->render('legal/politica_envio.html.twig', []);
    }

    #[Route('/politica-de-privacidad', name: 'app_politica_privacidad', methods: ['GET'])]
    public function politicaPrivacidad(EntityManagerInterface $entityManager): Response
    {
        return $this->render('legal/politica_privacidad.html.twig', []);
    }

    #[Route('/terminos_de_servicio', name: 'app_terminos_servicio', methods: ['GET'])]
    public function terminosServicio(EntityManagerInterface $entityManager): Response
    {
        return $this->render('legal/terminos_servicio.html.twig', []);
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
