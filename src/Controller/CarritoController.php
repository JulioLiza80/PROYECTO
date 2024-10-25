<?php

namespace App\Controller;

use App\Entity\Gafas;
use App\Entity\Lentillas;
use App\Service\CarritoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class CarritoController extends AbstractController
{

    
    #[Route('/{id}/aniadirProducto/{cat}', name: 'app_aniadir', methods: ['GET','POST'])]
    public function show( Request $request, $id, $cat, EntityManagerInterface $producto,CarritoManager $carritoManager ): Response
    { 
        if($cat==1){
            $gafas=$producto->getRepository(Gafas::class)->findOneById($id);
            $cantidad = $request->request->get('cantidad', 1);//cambiar a la variable recibida cuando se establezcan las cantidades
            $carritoManager->añadirA_CarritoGafas($gafas, $cantidad);
            return new JsonResponse(['suscess' => true]);
            
        }else if ($cat==2){
            $lentillas=$producto->getRepository(Lentillas::class)->findOneById($id);
            $cantidad = $request->request->get('cantidad', 1);//cambiar a la variable recibida cuando se estableca las cantidades
            $carritoManager->añadirA_CarritoLentillas($lentillas, $cantidad);
            return new JsonResponse(['suscess' => true]);
           
         }
        
     }



    #[Route('/{id}/eliminarCarrito/{cat}', name: 'app_carrito_eliminarProducto', methods: ['POST', 'GET'])]
    public function eliminarProductoAction($id,$cat, CarritoManager $carritoManager): Response
    {
       
        $carritoManager->eliminarDel_Carrito($id, $cat);

        return $this->render('carrito.html.twig', [
            'idcliente'=>$_ENV["APP_PAYPAL"]
        ]); 
    
    
        
    }


    #[Route('/carrito', name: 'app_carrito', methods: ['POST', 'GET'])]
    public function mostrarCarrito(RequestStack $request): Response
    { 
        $session = $request->getSession();
        $carrito= $session->get('carrito');
        
     
       return $this->render('carrito.html.twig', [

        'idcliente'=>$_ENV["APP_PAYPAL"]
       ]); 
       
     
      
        
    }



    /*{% for producto in app.session.get('carrito') %}
          recuperar sesion en plantillas
    */

}

