<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Romp
 *
 * @ORM\Table(name="romp", indexes={@ORM\Index(name="IDX_23AF5FC039FFE2AA", columns={"id_project_romp"}), @ORM\Index(name="IDX_23AF5FC02891A84D", columns={"id_contact_romp"})})
 * @ORM\Entity(repositoryClass="App\Repository\Romp")
 */
class Romp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_romp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="romp_id_romp_seq", allocationSize=1, initialValue=1)
     */
    private $idRomp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identifier", type="text", nullable=true)
     */
    private $identifier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submission_date", type="date", nullable=false)
     */
    private $submissionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="text", nullable=false)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="deliverable", type="text", nullable=false)
     */
    private $deliverable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="licence", type="text", nullable=true, options={"default"="CC-BY-4.0"})
     */
    private $licence = 'CC-BY-4.0';

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_project_romp", referencedColumnName="id_project")
     * })
     */
    private $idProjectRomp;

    /**
     * @var \Contact
     *
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contact_romp", referencedColumnName="id_contact")
     * })
     */
    private $idContactRomp;

    public function getIdRomp(): ?int
    {
        return $this->idRomp;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTimeInterface $submissionDate): self
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getDeliverable(): ?string
    {
        return $this->deliverable;
    }

    public function setDeliverable(string $deliverable): self
    {
        $this->deliverable = $deliverable;

        return $this;
    }

    public function getLicence(): ?string
    {
        return $this->licence;
    }

    public function setLicence(?string $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getIdProjectRomp(): ?Project
    {
        if($this->idProjectRomp)
        {
            return $this->idProjectRomp;
        }
        return $this->null;
        //Original contenait uniquement :
        // return $this->idProjectRomp;
    }

    public function setIdProjectRomp(?Project $idProjectRomp): self
    {
        $this->idProjectRomp = $idProjectRomp;

        return $this;
    }

    public function getIdContactRomp(): ?Contact
    {
        if($this->idContactRomp)
        {
            return $this->idContactRomp;
        }
        return $this->null;
        //Original contenait uniquement :
        // return $this->idContactRomp;
    }

    public function setIdContactRomp(?Contact $idContactRomp): self
    {
        $this->idContactRomp = $idContactRomp;

        return $this;
    }


}
