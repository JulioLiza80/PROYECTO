<?php

namespace App\Entity;

use App\Repository\GafasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GafasRepository::class)]
class Gafas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marca = null;

    #[ORM\Column(length: 255)]
    private ?string $modelo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?int $aro = null;

    #[ORM\Column]
    private ?int $puente = null;

    #[ORM\Column]
    private ?int $talla = null;

    #[ORM\Column(nullable: true)]
    private ?int $varilla = null;

    #[ORM\Column(length: 255)]
    private ?string $colorMontura = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colorLentes = null;

    #[ORM\Column(length: 255)]
    private ?string $materialMontura = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoMontura = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?int $iva = null;

    #[ORM\Column(nullable: true)]
    private ?int $descuento = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $destacado = null;

    /**
     * @var Collection<int, DetallePedido>
     */
    #[ORM\ManyToMany(targetEntity: DetallePedido::class, mappedBy: 'idGafas')]
    private Collection $detallePedidos;

    public function __construct()
    {
        $this->detallePedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): static
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): static
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getAro(): ?int
    {
        return $this->aro;
    }

    public function setAro(int $aro): static
    {
        $this->aro = $aro;

        return $this;
    }

    public function getPuente(): ?int
    {
        return $this->puente;
    }

    public function setPuente(int $puente): static
    {
        $this->puente = $puente;

        return $this;
    }

    public function getTalla(): ?int
    {
        return $this->talla;
    }

    public function setTalla(int $talla): static
    {
        $this->talla = $talla;

        return $this;
    }

    public function getVarilla(): ?int
    {
        return $this->varilla;
    }

    public function setVarilla(?int $varilla): static
    {
        $this->varilla = $varilla;

        return $this;
    }

    public function getColorMontura(): ?string
    {
        return $this->colorMontura;
    }

    public function setColorMontura(string $colorMontura): static
    {
        $this->colorMontura = $colorMontura;

        return $this;
    }

    public function getColorLentes(): ?string
    {
        return $this->colorLentes;
    }

    public function setColorLentes(?string $colorLentes): static
    {
        $this->colorLentes = $colorLentes;

        return $this;
    }

    public function getMaterialMontura(): ?string
    {
        return $this->materialMontura;
    }

    public function setMaterialMontura(string $materialMontura): static
    {
        $this->materialMontura = $materialMontura;

        return $this;
    }

    public function getTipoMontura(): ?string
    {
        return $this->tipoMontura;
    }

    public function setTipoMontura(string $tipoMontura): static
    {
        $this->tipoMontura = $tipoMontura;

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

    public function getIva(): ?int
    {
        return $this->iva;
    }

    public function setIva(int $iva): static
    {
        $this->iva = $iva;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(?int $descuento): static
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDestacado(): ?int
    {
        return $this->destacado;
    }

    public function setDestacado(?int $destacado): static
    {
        $this->destacado = $destacado;

        return $this;
    }

    /**
     * @return Collection<int, DetallePedido>
     */
    public function getDetallePedidos(): Collection
    {
        return $this->detallePedidos;
    }

    public function addDetallePedido(DetallePedido $detallePedido): static
    {
        if (!$this->detallePedidos->contains($detallePedido)) {
            $this->detallePedidos->add($detallePedido);
            $detallePedido->addIdGafa($this);
        }

        return $this;
    }

    public function removeDetallePedido(DetallePedido $detallePedido): static
    {
        if ($this->detallePedidos->removeElement($detallePedido)) {
            $detallePedido->removeIdGafa($this);
        }

        return $this;
    }
}
