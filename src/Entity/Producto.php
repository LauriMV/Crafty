<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $Imagen = null;

    #[ORM\Column]
    private ?int $Precio = null;

    /**
     * @var Collection<int, Categorias>
     */
    #[ORM\ManyToMany(targetEntity: Categorias::class)]
    private Collection $categorias;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): static
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->Imagen;
    }

    public function setImagen(string $Imagen): static
    {
        $this->Imagen = $Imagen;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->Precio;
    }

    public function setPrecio(int $Precio): static
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * @return Collection<int, Categorias>
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categorias $categoria): static
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias->add($categoria);
        }

        return $this;
    }

    public function removeCategoria(Categorias $categoria): static
    {
        $this->categorias->removeElement($categoria);

        return $this;
    }
}
