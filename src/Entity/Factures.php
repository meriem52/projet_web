<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturesRepository::class)]
class Factures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?reservations $reservation_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_facturation = null;

    #[ORM\Column(length: 255)]
    private ?string $statut_paiement = null;

    #[ORM\Column(length: 255)]
    private ?string $mode_paiement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationId(): ?reservations
    {
        return $this->reservation_id;
    }

    public function setReservationId(?reservations $reservation_id): static
    {
        $this->reservation_id = $reservation_id;

        return $this;
    }

    public function getDateFacturation(): ?\DateTimeInterface
    {
        return $this->date_facturation;
    }

    public function setDateFacturation(\DateTimeInterface $date_facturation): static
    {
        $this->date_facturation = $date_facturation;

        return $this;
    }

    public function getStatutPaiement(): ?string
    {
        return $this->statut_paiement;
    }

    public function setStatutPaiement(string $statut_paiement): static
    {
        $this->statut_paiement = $statut_paiement;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(string $mode_paiement): static
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }
}
