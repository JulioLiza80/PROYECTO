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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\UserType;

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

    #[Route('/envio', name: 'app_envio', methods: ['GET', 'POST'])]
    public function envio(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Crear formulario basado en el tipo de usuario (solo con los campos específicos)
        $form = $this->createForm(UserType::class, $user, [
            'validation_groups' => ['Default'], // Personaliza si necesitas
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Guardar datos en la base de datos
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirigir a la vista del carrito simplificada
            return $this->redirectToRoute('app_resumen_pago');
        }

        return $this->render('envio.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/resumen-pago', name: 'app_resumen_pago', methods: ['GET'])]
    public function resumenPago(SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);

        return $this->render('resumen_pago.html.twig', [
            'carrito' => $carrito,
            
        'idcliente'=>$_ENV["APP_PAYPAL"]

        ]);
    }



    /*{% for producto in app.session.get('carrito') %}
          recuperar sesion en plantillas
    */

}

