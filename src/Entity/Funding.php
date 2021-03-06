<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funding
 *
 * @ORM\Table(name="funding", indexes={@ORM\Index(name="IDX_D30DD1D6A07C33DF", columns={"id_contact_funding"})})
 * @ORM\Entity(repositoryClass="App\Repository\FundingRepository")
 */
class Funding
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_funding", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="funding_id_funding_seq", allocationSize=1, initialValue=1)
     */
    private $idFunding;

    /**
     * @var int
     *
     * @ORM\Column(name="grant_funding", type="integer", nullable=false)
     */
    private $grantFunding;

    /**
     * @var \Contact
     *
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contact_funding", referencedColumnName="id_contact")
     * })
     */
    private $idContactFunding;

    public function getIdFunding(): ?int
    {
        return $this->idFunding;
    }

    public function getGrantFunding(): ?int
    {
        return $this->grantFunding;
    }

    public function setGrantFunding(int $grantFunding): self
    {
        $this->grantFunding = $grantFunding;

        return $this;
    }

    public function getIdContactFunding(): ?Contact
    {
        return $this->idContactFunding;
    }

    public function setIdContactFunding(?Contact $idContactFunding): self
    {
        $this->idContactFunding = $idContactFunding;

        return $this;
    }


}
