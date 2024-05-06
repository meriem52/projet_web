<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: chambres::class, mappedBy: 'reservations')]
    private Collection $chambre_id;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_arrivee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_depart = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nombre_nuits = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $prix_total = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?clients $client_id = null;

    #[ORM\ManyToMany(targetEntity: services::class)]
    private Collection $service_id;

    public function __construct()
    {
        $this->chambre_id = new ArrayCollection();
        $this->service_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, chambres>
     */
    public function getChambreId(): Collection
    {
        return $this->chambre_id;
    }

    public function addChambreId(chambres $chambreId): static
    {
        if (!$this->chambre_id->contains($chambreId)) {
            $this->chambre_id->add($chambreId);
            $chambreId->setReservations($this);
        }

        return $this;
    }

    public function removeChambreId(chambres $chambreId): static
    {
        if ($this->chambre_id->removeElement($chambreId)) {
            // set the owning side to null (unless already changed)
            if ($chambreId->getReservations() === $this) {
                $chambreId->setReservations(null);
            }
        }

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(\DateTimeInterface $date_arrivee): static
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): static
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getNombreNuits(): ?int
    {
        return $this->nombre_nuits;
    }

    public function setNombreNuits(int $nombre_nuits): static
    {
        $this->nombre_nuits = $nombre_nuits;

        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->prix_total;
    }

    public function setPrixTotal(string $prix_total): static
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getClientId(): ?clients
    {
        return $this->client_id;
    }

    public function setClientId(?clients $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @return Collection<int, services>
     */
    public function getServiceId(): Collection
    {
        return $this->service_id;
    }

    public function addServiceId(services $serviceId): static
    {
        if (!$this->service_id->contains($serviceId)) {
            $this->service_id->add($serviceId);
        }

        return $this;
    }

    public function removeServiceId(services $serviceId): static
    {
        $this->service_id->removeElement($serviceId);

        return $this;
    }
}
