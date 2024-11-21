<?php

namespace App\Entity;

use App\Repository\GafasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GafasRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aro = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $puente = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $talla = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $varilla = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colorMontura = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colorLentes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $materialMontura = null;

    #[ORM\Column(length: 255, nullable: true)]
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

    #[Vich\UploadableField(mapping: 'gafas', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    // Métodos getters y setters...

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

    public function getAro(): ?string
    {
        return $this->aro;
    }

    public function setAro(?string $aro): static
    {
        $this->aro = $aro;

        return $this;
    }

    public function getPuente(): ?string
    {
        return $this->puente;
    }

    public function setPuente(?string $puente): static
    {
        $this->puente = $puente;

        return $this;
    }

    public function getTalla(): ?string
    {
        return $this->talla;
    }

    public function setTalla(?string $talla): static
    {
        $this->talla = $talla;

        return $this;
    }

    public function getVarilla(): ?string
    {
        return $this->varilla;
    }

    public function setVarilla(?string $varilla): static
    {
        $this->varilla = $varilla;

        return $this;
    }

    public function getColorMontura(): ?string
    {
        return $this->colorMontura;
    }

    public function setColorMontura(?string $colorMontura): static
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

    public function setMaterialMontura(?string $materialMontura): static
    {
        $this->materialMontura = $materialMontura;

        return $this;
    }

    public function getTipoMontura(): ?string
    {
        return $this->tipoMontura;
    }

    public function setTipoMontura(?string $tipoMontura): static
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

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
}
