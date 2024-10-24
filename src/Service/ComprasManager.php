<?php

namespace App\Service;

use App\Entity\DetalleCompra;
use App\Entity\DetallePedido;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use App\Entity\Pedidos;
use App\Entity\User;
use App\Repository\DetalleCompraRepository;
use App\Repository\DetallePedidoRepository;
use App\Repository\PedidoRepository;
use App\Repository\GafasRepository;
use App\Repository\LentillasRepository;
use App\Repository\PedidosRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\RequestStack;


class ComprasManager
{
  private $requestStack;
  private $detalleCompraRepository;
  private $detallePedidoRepository;
  private $pedidosRepository;
  private $gafasRepository;
  private $lentillasRepository;
 
  
  public function __construct(RequestStack $requestStack, DetalleCompraRepository $detalleCompraRepository, PedidosRepository $pedidosRepository, GafasRepository $gafasRepository, LentillasRepository $lentillasRepository, DetallePedidoRepository $detallePedidoRepository )//AÑADIR DETALLEPEDIDO
  {
    $this->requestStack= $requestStack;
    $this->detalleCompraRepository= $detalleCompraRepository;
    $this->detallePedidoRepository= $detallePedidoRepository;
    $this->pedidosRepository= $pedidosRepository;
    $this->gafasRepository=  $gafasRepository;
    $this->lentillasRepository= $lentillasRepository;
  
  }

  public function nuevaCompra(DetalleCompra $detallecompra, User $user, $t): DetalleCompra
  {
   
    $detallecompra = new DetalleCompra();
    $detallecompra->setIdUsuario($user);
    $detallecompra->setIdTransaccion($t);//CAMPO RECIBIDO
    $fecha = new \DateTime('@'.strtotime('now'));
    $detallecompra->setFecha($fecha);
    $detallecompra->setStatus('complete'); //CAMPO RECIBIDO
    $detallecompra->setEmail($user->getEmail());
    //$detallecompra->serIdCliente();CAMPO RECIBIDO
    $session = $this->requestStack->getSession();
    $carrito= $session->get('carrito');
    $total=0;
    foreach($carrito as $elemento){
     
      $precio=$elemento['producto']->getPrecio();
      $total=$total+$precio;
    }
    $detallecompra->setTotal($total); 
    
    $this->detalleCompraRepository->save($detallecompra, true);

    $prueba=$this->detalleCompraRepository->findOneByIdTransaccion($t);
    return $prueba;
  }

  public function nuevoPedido(DetalleCompra $detalleCompra, Pedidos $pedido, User $user, $t):Pedidos
  {
    $detalleCompra= new DetalleCompra();
    $detalleCompra= $this->detalleCompraRepository->findOneByIdTransaccion($t);
    if($detalleCompra->getStatus()=='complete'){
       $pedido= new Pedidos();
       $pedido->setIdUsuarioPedidos($user);
       $pedido->setIdCompra($detalleCompra);
       $pedido->setDireccion($user->getDireccion());
       $pedido->setCiudad($user->getCiudad());
       $pedido->setCp($user->getCp());
       $pedido->setPrecio($detalleCompra->getTotal());
       $pedido->setIdTransaccion($detalleCompra->getIdTransaccion());
       $this->pedidosRepository->save($pedido, true);
    }
   
   

    return $pedido;
  }

  public function stocks(){
       //recuperamos carrito
    $session = $this->requestStack->getSession();
    $carrito= $session->get('carrito');
    foreach($carrito as $elemento){
     if($elemento['producto']->getCategoria()==1){
          $gafas= New Gafas();
          $gafas=$this->gafasRepository->findOneById($elemento['producto']->getId());
          $this->gafasRepository->actualizarStock($elemento['cantidad'], $gafas);
      
       }if($elemento['producto']->getCategoria()==2){
          $lentillas= New Lentillas();
          $lentillas=$this->lentillasRepository->findOneById($elemento['producto']->getId());
          $this->lentillasRepository->actualizarStock($elemento['cantidad'],$lentillas);
         
    }
   
  }
}

  
  public function nuevoDetallePedido( Pedidos $pedido, DetallePedido $detallePedido, $t) :DetallePedido
  {
    
    //recuperamos Pedido
    $pedido= new Pedidos();
    $pedido= $this->pedidosRepository->findOneByIdTransaccion($t);
    //recuperamos carrito
    $session = $this->requestStack->getSession();
    $carrito= $session->get('carrito');
    $detallePedido= New DetallePedido();
    //creamos los detalles pedidos
    foreach($carrito as $elemento){
      $detallePedido= New DetallePedido();
      $detallePedido->setIdPedido($pedido->getId());
      $detallePedido->setIdProducto($elemento['producto']->getId());
      $detallePedido->setCategoriaProducto($elemento['producto']->getCategoria());
      $detallePedido->setCantidad($elemento['cantidad']);
      $detallePedido->setPrecio($elemento['producto']->getPrecio());
      $this->detallePedidoRepository->save($detallePedido, true);   
    
    }


    //vaciamos carrito
     $session->remove('carrito');
      return $detallePedido;
  }
 } 

