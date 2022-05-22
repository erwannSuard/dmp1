<?php

namespace App\Entity;

use App\Entity\Funding;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project", indexes={@ORM\Index(name="IDX_2FB3D0EEF3B54EC9", columns={"id_ref_project"}), @ORM\Index(name="IDX_2FB3D0EEDA89326", columns={"id_funding_project"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_project", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="project_id_project_seq", allocationSize=1, initialValue=1)
     */
    private $idProject;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=false)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="acronyme", type="text", nullable=false)
     */
    private $acronyme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text", nullable=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="text", nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="objectives", type="text", nullable=false)
     */
    private $objectives;

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ref_project", referencedColumnName="id_project")
     * })
     */
    private $idRefProject;

    /**
     * @var \Funding
     *
     * @ORM\ManyToOne(targetEntity="Funding")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_funding_project", referencedColumnName="id_funding")
     * })
     */
    private $idFundingProject;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contact", mappedBy="idProject", cascade={"persist"})
     */
    private $idContact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idContact = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProject(): ?int
    {
        return $this->idProject;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getAcronyme(): ?string
    {
        return $this->acronyme;
    }

    public function setAcronyme(string $acronyme): self
    {
        $this->acronyme = $acronyme;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getObjectives(): ?string
    {
        return $this->objectives;
    }

    public function setObjectives(string $objectives): self
    {
        $this->objectives = $objectives;

        return $this;
    }

    public function getIdRefProject(): ?self
    {
        // if($this->idRefProject)
        // {
        //     return $this->idRefProject;
        // }
        // return $this->null;
        //Original contenait uniquement :
        return $this->idRefProject;
    }

    public function setIdRefProject(?self $idRefProject): self
    {
        $this->idRefProject = $idRefProject;

        return $this;
    }

    public function getIdFundingProject(): ?Funding
    {
        // if($this->idFundingProject)
        // {
        //     return $this->idFundingProject;
        // }
        // return $this->null;
        //Original contenait uniquement :
        return $this->idFundingProject;
    }

    public function setIdFundingProject(?Funding $idFundingProject): self
    {
        $this->idFundingProject = $idFundingProject;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getIdContact(): Collection
    {
        return $this->idContact;
    }

    public function addIdContact(Contact $idContact): self
    {
        if (!$this->idContact->contains($idContact)) {
            $this->idContact[] = $idContact;
            $idContact->addIdProject($this);
        }

        return $this;
    }

    public function removeIdContact(Contact $idContact): self
    {
        if ($this->idContact->removeElement($idContact)) {
            $idContact->removeIdProject($this);
        }

        return $this;
    }

}
