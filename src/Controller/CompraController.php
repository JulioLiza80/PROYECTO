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
                  
              }
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
                              ->subject('Pedido' . $pedido->getId() . ', Optica Nova')
                              ->htmlTemplate('correoCompra/clienteCompra.html.twig')
                              ->context([
                              'carrito' => $session->get('carrito'),
                              ]);
                        $mailer->send($email);
                        //correo tienda
                        // $email2=(new TemplatedEmail())
                        //       ->from(new Address('opticanovaproyecto@gmail.com', 'Optica Nova Pedidos'))
                        //       ->to(correopedidos@.com)
                        //       ->subject('Pedido' . $pedido->getId() . ', Optica Nova')
                        //       ->htmlTemplate('correoCompra/pedido.html.twig')
                        //       ->context([
                        //       'carrito' => $session->get('carrito'),
                        //       ]);
                        // $mailer->send($email2);

                  //actualizar stock
                        $comprasManager->stocks();


                  //creacion de detallePedido
                        $comprasManager->nuevoDetallePedido($pedido, new DetallePedido(),$pedido->getIdTransaccion());
                        return $this->redirectToRoute('app_home');
                  //supuesto de pago incompleto
                  }else{

                            //generar pedido imcompleto


                  }
            }
      //si no exsisten las variables necesarias
            }else{
            return $this->render('index.html.twig', []);
      
            }
      }
}

      



