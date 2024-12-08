<?php

namespace App\Entity;

use App\Repository\DetallePedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: DetallePedidoRepository::class)]
class DetallePedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $IdPedido = null;

    #[ORM\Column]
    private ?int $IdProducto = null;

    #[ORM\Column]
    private ?int $categoriaProducto = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?int $Idusuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPedido(): ?int
    {
        return $this->IdPedido;
    }

    public function setIdPedido(int $IdPedido): static
    {
        $this->IdPedido = $IdPedido;

        return $this;
    }

    public function getIdProducto(): ?int
    {
        return $this->IdProducto;
    }

    public function setIdProducto(int $IdProducto): static
    {
        $this->IdProducto = $IdProducto;

        return $this;
    }

    public function getCategoriaProducto(): ?int
    {
        return $this->categoriaProducto;
    }

    public function setCategoriaProducto(int $categoriaProducto): static
    {
        $this->categoriaProducto = $categoriaProducto;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getIdusuario(): ?int
    {
        return $this->Idusuario;
    }

    public function setIdusuario(int $Idusuario): static
    {
        $this->Idusuario = $Idusuario;

        return $this;
    }
}
