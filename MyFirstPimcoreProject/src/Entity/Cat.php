<?php

namespace App\Entity;

use App\Enum\Breed;
use App\Enum\Gender;
use App\Enum\HairColour;
use App\Repository\CatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatRepository::class)]
#[ORM\Table(name: 'app_cats')]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', enumType: Gender::class)] 
    private ?string $gender = null;

    #[ORM\Column(type: 'string', enumType: HairColour::class)] 
    private ?string $colour = null;
    
    #[ORM\Column(type: 'string', enumType: Breed::class)] 
    private ?string $breed = Breed::European->value;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $monthOfBirth = null;
    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;
    
    #[ORM\Column]
    private ?bool $isNeutered = false;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $neuterDate = null;

    #[ORM\Column]
    private ?bool $isChipped = false;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $chipNumber = null;

    #[ORM\Column]
    private ?bool $isFivPositive = false;


    #[ORM\Column]
    private ?bool $isLeucosePositive = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

        public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): static
    {
        $this->colour = $colour;

        return $this;
    }

    public function getMonthOfBirth(): ?\DateTimeImmutable
    {
        return $this->monthOfBirth;
    }

    public function setMonthOfBirth(?\DateTimeImmutable $monthOfBirth): static
    {
        $this->monthOfBirth = $monthOfBirth;

        return $this;
    }

    public function getAge(): ?int
    {
        if ($this->monthOfBirth === null) {
            return null;
        }

        $now = new \DateTimeImmutable();
        $age = $now->diff($this->monthOfBirth)->y;

        return $age;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): static
    {
        $this->breed = $breed;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isNeutered(): ?bool
    {
        return $this->isNeutered;
    }

    public function setIsNeutered(bool $isNeutered): static
    {
        $this->isNeutered = $isNeutered;

        return $this;
    }

        public function getNeuterDate(): ?\DateTime
    {
        return $this->neuterDate;
    }

    public function setNeuterDate(?\DateTime $neuterDate): static
    {
        $this->neuterDate = $neuterDate;

        return $this;
    }
    public function isChipped(): ?bool
    {
        return $this->isChipped;
    }

    public function setIsChipped(bool $isChipped): static
    {
        $this->isChipped = $isChipped;

        return $this;
    }

    public function getChipNumber(): ?string
    {
        return $this->chipNumber;
    }

    public function setChipNumber(?string $chipNumber): static
    {
        $this->chipNumber = $chipNumber;

        return $this;
    }

    public function isFivPositive(): ?bool
    {
        return $this->isFivPositive;
    }

    public function setIsFivPositive(bool $isFivPositive): static
    {
        $this->isFivPositive = $isFivPositive;

        return $this;
    }

    public function isLeucosePositive(): ?bool
    {
        return $this->isLeucosePositive;
    }

    public function setIsLeucosePositive(bool $isLeucosePositive): static
    {
        $this->isLeucosePositive = $isLeucosePositive;

        return $this;
    }
}
