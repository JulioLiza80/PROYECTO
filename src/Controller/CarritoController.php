<?php

namespace App\Controller;

use App\Entity\Gafas;
use App\Entity\Lentillas;
use App\Service\CarritoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class CarritoController extends AbstractController
{

    #[Route('/{id}/aniadirCarritoGafas', name: 'app_carrito_aniadirGafas', methods: ['POST', 'GET'])]
    public function añadirGafasAction(Request $request, Gafas $gafas, CarritoManager $carritoManager): Response
    {
        $cantidad = $request->request->get('cantidad', 1);//cambiar a null cuando se establezcan las cantidades

      
        $carritoManager->añadirA_CarritoGafas($gafas, $cantidad);
        //dd($_SESSION);
        return new JsonResponse(['suscess' => true]);
    
    }

    #[Route('/{id}/aniadirCarritoLentillas', name: 'app_carrito_aniadirLentillas', methods: ['POST', 'GET'])]
    public function añadirLentillasAction(Request $request, Lentillas $lentillas, CarritoManager $carritoManager): Response
    {
        $cantidad = $request->request->get('cantidad', 1);//cambiar a null cuando se estableca las cantidades

        $carritoManager->añadirA_CarritoLentillas($lentillas, $cantidad);

        return new JsonResponse(['suscess' => true]);
    
    }


    #[Route('/{id}/eliminarCarrito/{cat}', name: 'app_carrito_eliminarProducto', methods: ['POST', 'GET'])]
    public function eliminarProductoAction($id, CarritoManager $carritoManager)//: Response
    {
        $cat=$_GET['cat'];
        $carritoManager->eliminarDel_Carrito($id, $cat);

        //return $this->render('carrito.html.twig', []); 
    
        return $this->redirectToRoute('app_carrito', [], Response::HTTP_SEE_OTHER);
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

