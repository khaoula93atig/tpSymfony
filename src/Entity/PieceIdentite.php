<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\PieceIdentiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PieceIdentiteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PieceIdentite
{
    use TimeStamp;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * @ORM\OneToOne(targetEntity=Personne::class, mappedBy="pieceIdentite", cascade={"persist", "remove"})
     */
    private $personne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }
    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        // set (or unset) the owning side of the relation if necessary
        $newPieceIdentite = null === $personne ? null : $this;
        if ($personne->getPieceIdentite() !== $newPieceIdentite) {
            $personne->setPieceIdentite($newPieceIdentite);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getType().' '.$this->getIdentifiant();
    }


}
