<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $titulo = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $fechaPublicacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $unidadesVendidas = null;

    /**
     * @var Collection<int, Autor>
     */
    #[ORM\ManyToMany(targetEntity: Autor::class, inversedBy: 'libros')]
    private Collection $autores;

    #[ORM\ManyToOne(inversedBy: 'libros')]
    private ?Editorial $editorial = null;

    public function __construct()
    {
        $this->autores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeImmutable
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(?\DateTimeImmutable $fechaPublicacion): static
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    public function getUnidadesVendidas(): ?int
    {
        return $this->unidadesVendidas;
    }

    public function setUnidadesVendidas(?int $unidadesVendidas): static
    {
        $this->unidadesVendidas = $unidadesVendidas;

        return $this;
    }

    /**
     * @return Collection<int, Autor>
     */
    public function getAutores(): Collection
    {
        return $this->autores;
    }

    public function addAutore(Autor $autore): static
    {
        if (!$this->autores->contains($autore)) {
            $this->autores->add($autore);
        }

        return $this;
    }

    public function removeAutore(Autor $autore): static
    {
        $this->autores->removeElement($autore);

        return $this;
    }

    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): static
    {
        $this->editorial = $editorial;

        return $this;
    }
}
