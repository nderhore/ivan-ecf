<?php

namespace App\Entity;

use App\Repository\OpinionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OpinionsRepository::class)]
#[UniqueEntity(fields: 'lastname', message: "Vous avez déjà laissé un commentaire.")]

class Opinions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\Regex("/[-'0-9a-zÀ-ÿ]+$/")]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 2, max: 255)]
    #[Assert\Regex("/[-',;:.?!0-9a-zÀ-ÿ]+$/")]
    private ?string $commentary = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\Regex("/[1-5]+$/")]
    private ?int $grade = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $is_validated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(string $commentary): static
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function isIsValidated(): ?bool
    {
        return $this->is_validated;
    }

    public function setIsValidated(bool $is_validated): static
    {
        $this->is_validated = $is_validated;

        return $this;
    }
}
