<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[Vich\Uploadable]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apellido2 = null;

    #[ORM\Column]
    private bool $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direccion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ciudad = null;

    #[ORM\Column(nullable: true)]
    private ?int $cp = null;

    /**
     * @var Collection<int, DetalleCompra>
     */
    #[ORM\OneToMany(targetEntity: DetalleCompra::class, mappedBy: 'idUsuario')]
    private Collection $detalleCompras;

    /**
     * @var Collection<int, Pedidos>
     */
    #[ORM\OneToMany(targetEntity: Pedidos::class, mappedBy: 'idUsuarioPedidos')]
    private Collection $pedidos;

    #[Vich\UploadableField(mapping: 'user', fileNameProperty: 'documentName')]
    private ?File $documentFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $documentName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->detalleCompras = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): static
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(?string $apellido2): static
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(?string $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(?int $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection<int, DetalleCompra>
     */
    public function getDetalleCompras(): Collection
    {
        return $this->detalleCompras;
    }

    public function addDetalleCompra(DetalleCompra $detalleCompra): static
    {
        if (!$this->detalleCompras->contains($detalleCompra)) {
            $this->detalleCompras->add($detalleCompra);
            $detalleCompra->setIdUsuario($this);
        }

        return $this;
    }

    public function removeDetalleCompra(DetalleCompra $detalleCompra): static
    {
        if ($this->detalleCompras->removeElement($detalleCompra)) {
            // set the owning side to null (unless already changed)
            if ($detalleCompra->getIdUsuario() === $this) {
                $detalleCompra->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pedidos>
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedidos $pedido): static
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos->add($pedido);
            $pedido->setIdUsuarioPedidos($this);
        }

        return $this;
    }

    public function removePedido(Pedidos $pedido): static
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getIdUsuarioPedidos() === $this) {
                $pedido->setIdUsuarioPedidos(null);
            }
        }

        return $this;
    }

    // Document management
    public function setDocumentFile(?File $documentFile = null): void
    {
        $this->documentFile = $documentFile;

        if (null !== $documentFile) {
            // Ensure at least one field changes if using Doctrine to trigger events
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    public function setDocumentName(?string $documentName): void
    {
        $this->documentName = $documentName;
    }

    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    // Replacement for Serializable methods
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'roles' => $this->roles,
            'password' => $this->password,
            'nombre' => $this->nombre,
            'apellido1' => $this->apellido1,
            'isVerified' => $this->isVerified,
            'documentName' => $this->documentName,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'cp' => $this->cp,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->roles = $data['roles'];
        $this->password = $data['password'];
        $this->nombre = $data['nombre'];
        $this->apellido1 = $data['apellido1'];
        $this->isVerified = $data['isVerified'];
        $this->documentName = $data['documentName'];
        $this->direccion = $data['direccion'];
        $this->ciudad = $data['ciudad'];
        $this->cp = $data['cp'];
    }
}
