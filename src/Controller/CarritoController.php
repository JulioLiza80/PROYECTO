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

    
    #[Route('/{id}/aniadirProducto/{cat}', name: 'app_aniadir', methods: ['GET', 'POST'])]
    public function show(Request $request, $id, $cat, EntityManagerInterface $producto, CarritoManager $carritoManager): Response
    { 
        $session = $request->getSession();
        $productoSeleccionado = null;

        if($cat == "1") {
            $productoSeleccionado = $producto->getRepository(Gafas::class)->find($id);
        } else if($cat == "2") {
            $productoSeleccionado = $producto->getRepository(Lentillas::class)->find($id);
        }

        if ($productoSeleccionado) {
            $carrito = $session->get('carrito', []);
            $productoExistente = false;

            foreach ($carrito as &$productoEnCarrito) {
                if ($productoEnCarrito['producto']->getId() === $productoSeleccionado->getId()) {
                    $productoEnCarrito['cantidad']++;
                    $productoExistente = true;
                    break;
                }
            }

            if (!$productoExistente) {
                $carrito[] = [
                    'producto' => $productoSeleccionado,
                    'cantidad' => 1,
                ];
            }

            $session->set('carrito', $carrito);
        }

        return $this->redirectToRoute('app_carrito');
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

    
    #[Route('/actualizar-carrito/{id}/{cantidad}', name: 'app_actualizar_carrito', methods: ['POST'])]
    public function actualizarCarrito(Request $request, int $id, int $cantidad): JsonResponse
    {
        $session = $request->getSession();
        $carrito = $session->get('carrito', []);
        $total = 0;
        $productoActualizado = null;

        foreach ($carrito as &$producto) {
            if ($producto['producto']->getId() === $id) {
                $stock = $producto['producto']->getStock();

            // Si la cantidad excede el stock, ajustamos al máximo permitido
            if ($cantidad > $stock) {
                $cantidad = $stock;
            } elseif ($cantidad < 1) {
                $cantidad = 1;
            }

                $producto['cantidad'] = $cantidad; // Actualizar la cantidad
                $productoActualizado = [
                    'id' => $id,
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['producto']->getPrecio()
                ];
            }

            // Calcular el total actualizado
            $total += $producto['producto']->getPrecio() * $producto['cantidad'];
        }

        $session->set('carrito', $carrito);

        return new JsonResponse([
            'message' => 'Cantidad actualizada correctamente.',
            'total' => $total,
            'producto' => $productoActualizado
        ], 200);
    }


    /*{% for producto in app.session.get('carrito') %}
          recuperar sesion en plantillas
    */

}

