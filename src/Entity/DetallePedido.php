<?php

namespace App\Entity;

use App\Repository\DetallePedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetallePedidoRepository::class)]
class DetallePedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Pedidos>
     */
    #[ORM\OneToMany(targetEntity: Pedidos::class, mappedBy: 'detallePedido')]
    private Collection $idPedido;

    /**
     * @var Collection<int, Gafas>
     */
    #[ORM\ManyToMany(targetEntity: Gafas::class, inversedBy: 'detallePedidos')]
    private Collection $idGafas;

    /**
     * @var Collection<int, Lentillas>
     */
    #[ORM\ManyToMany(targetEntity: Lentillas::class, inversedBy: 'detallePedidos')]
    private Collection $idLentillas;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $precio = null;

    public function __construct()
    {
        $this->idPedido = new ArrayCollection();
        $this->idGafas = new ArrayCollection();
        $this->idLentillas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Pedidos>
     */
    public function getIdPedido(): Collection
    {
        return $this->idPedido;
    }

    public function addIdPedido(Pedidos $idPedido): static
    {
        if (!$this->idPedido->contains($idPedido)) {
            $this->idPedido->add($idPedido);
            $idPedido->setDetallePedido($this);
        }

        return $this;
    }

    public function removeIdPedido(Pedidos $idPedido): static
    {
        if ($this->idPedido->removeElement($idPedido)) {
            // set the owning side to null (unless already changed)
            if ($idPedido->getDetallePedido() === $this) {
                $idPedido->setDetallePedido(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Gafas>
     */
    public function getIdGafas(): Collection
    {
        return $this->idGafas;
    }

    public function addIdGafa(Gafas $idGafa): static
    {
        if (!$this->idGafas->contains($idGafa)) {
            $this->idGafas->add($idGafa);
        }

        return $this;
    }

    public function removeIdGafa(Gafas $idGafa): static
    {
        $this->idGafas->removeElement($idGafa);

        return $this;
    }

    /**
     * @return Collection<int, Lentillas>
     */
    public function getIdLentillas(): Collection
    {
        return $this->idLentillas;
    }

    public function addIdLentilla(Lentillas $idLentilla): static
    {
        if (!$this->idLentillas->contains($idLentilla)) {
            $this->idLentillas->add($idLentilla);
        }

        return $this;
    }

    public function removeIdLentilla(Lentillas $idLentilla): static
    {
        $this->idLentillas->removeElement($idLentilla);

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
}
