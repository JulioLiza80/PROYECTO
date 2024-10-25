<?php

namespace App\Controller;

use App\Entity\DetalleCompra;
use App\Entity\DetallePedido;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use App\Entity\Pedidos;
use App\Service\ComprasManager;
use SebastianBergmann\Template\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompraController extends AbstractController
{
      #[Route('/compra', name: 'app_compra', methods: ['POST', 'GET'])]
      public function crearCompra(RequestStack $request, ComprasManager $comprasManager, MailerInterface $mailer): Response
      { 
            $session = $request->getSession();
            $carrito= $session->get('carrito');
            $total=0;
            foreach($carrito as $elemento){

            $precio=$elemento['producto']->getPrecio();
            $total=$total+$precio;
      }
            
            if(isset($_POST['total'] ) && isset($_POST['detalles']))
      {
            $detalles= json_decode($_POST['detalles']);

            if($_POST['total']>=$total){
                  $status=null;
                  $id=null;

            foreach($detalles as $key => $valor){
                  if($key=='status'){
                  $status=$valor;
                  }
                  if($key=='id'){
                  $id=$valor;
                  }
                  
              }  //1º SUPUESTO ---TODO VA BIEN ------
                        if($status=='COMPLETED'){

                  //creació de detalles compra
                        $compra=$comprasManager->nuevaCompra(new DetalleCompra(),$this->getUser(),$id);


                  //creación de pedido
                        $pedido=$comprasManager->nuevoPedido($compra, new Pedidos(), $this->getUser(),$compra->getIdTransaccion());


                  //creacion de correos
                        //correo cliente
                        $email = (new TemplatedEmail())
                              ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova'))
                              ->to((string) $this->getUser()->getUserIdentifier())
                              ->subject('Pedido :' . $pedido->getId() . ', Optica Nova')
                              ->htmlTemplate('correos/clienteCompra.html.twig')
                              ->context([
                              'carrito' => $session->get('carrito'),
                              ]);
                        $mailer->send($email);
                        //correo tienda
                        // $email2=(new TemplatedEmail())
                        //       ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova Pedidos'))
                        //       ->to(correopedidos@.com)
                        //       ->subject('Pedido' . $pedido->getId() . ', Optica Nova')
                        //       ->htmlTemplate('correos/pedido.html.twig')
                        //       ->context([
                        //       'carrito' => $session->get('carrito'),
                        //       ]);
                        // $mailer->send($email2);

                  //actualizar stock
                        $comprasManager->stocks();


                  //creacion de detallePedido
                        $comprasManager->nuevoDetallePedido($pedido, new DetallePedido(),$pedido->getIdTransaccion());
                        return $this->redirectToRoute('app_home');
                  //2º SUPUESTO -- PAYPAL DEVUELVE ESTADO DIFERENTE A COMPLETO
                  }else{

                        //generamos detalle de compra e informamos a tienda y cliente del problema
                        $compra=$comprasManager->nuevaCompra(new DetalleCompra(),$this->getUser(),$id);

                        //creacion de correos
                        //correo cliente
                        $email = (new TemplatedEmail())
                              ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova'))
                              ->to((string) $this->getUser()->getUserIdentifier())
                              ->subject('Compra :' . $compra->getId() . ', Optica Nova')
                              ->htmlTemplate('correos/procesoIncompleto.html.twig')
                              ->context([
                              'carrito' => $session->get('carrito'),
                              ]);
                        $mailer->send($email);
                        //correo tienda
                        // $email2=(new TemplatedEmail())
                        //       ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova Pedidos'))
                        //       ->to(correopedidos@.com)
                        //       ->subject('Compra' . $compra->getId() . ', Optica Nova')
                        //       ->htmlTemplate('correos/procesoIncompleto.html.twig')
                        //       ->context([
                        //       'carrito' => $session->get('carrito'),
                        //       ]);
                        // $mailer->send($email2);
                  //vaciamos carrito
                  $session->remove('carrito');
                  return $this->redirectToRoute('app_home');

                  }
                  // 3º SUPESTO -- EL PAGO HA SIDO INFERIOR A LA CANTIDAD RECUPERADA DEL CARRITO
            }else{

                  foreach($detalles as $key => $valor){
                  
                        if($key=='id'){
                              $id=$valor;
                        }
                  }
                  //si el pago realizado es inferior al recogido en el carrito
                  //generamos detalle de compra e informamos a tienda y cliente del problema
                  $compra=$comprasManager->nuevaCompra(new DetalleCompra(),$this->getUser(),$id);

                  //creacion de correos
                  //correo cliente
                  $email = (new TemplatedEmail())
                        ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova'))
                        ->to((string) $this->getUser()->getUserIdentifier())
                        ->subject('Compra :' . $compra->getId() . ', Optica Nova')
                        ->htmlTemplate('correos/pagoIncorrecto.html.twig')
                        ->context([
                        'carrito' => $session->get('carrito'),
                        ]);
                  $mailer->send($email);
                  //correo tienda
                  // $email2=(new TemplatedEmail())
                  //       ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova Pedidos'))
                  //       ->to(correopedidos@.com)
                  //       ->subject('Compra' . $compra->getId() . ', Optica Nova')
                  //       ->htmlTemplate('correos/pagoIncorrecto.html.twig')
                  //       ->context([
                  //       'carrito' => $session->get('carrito'),
                  //       ]);
                  // $mailer->send($email2);
            //vaciamos carrito
                  $session->remove('carrito');
                  return $this->redirectToRoute('app_home');


            }
              //4º SUPUESTO --NO EXISTEN LAS VARIABLES NECESARIAS
      }else{
      
            $session->remove('carrito');
            return $this->render('index.html.twig', []);
            $session->remove('carrito');
            return $this->redirectToRoute('app_home');
      }

}



}

      



