<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idContact;

    /**
     * @var string
     *
     * @ORM\Column(name="type_contact", type="text", nullable=false)
     */
    private $typeContact;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="text", nullable=false)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="text", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="text", nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliation", type="text", nullable=false)
     */
    private $affiliation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identifier", type="text", nullable=true)
     */
    private $identifier;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="idContact")
     * @ORM\JoinTable(name="contact_project",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_contact", referencedColumnName="id_contact")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_project", referencedColumnName="id_project")
     *   }
     * )
     */
    private $idProject;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProject = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdContact(): ?int
    {
        return $this->idContact;
    }

    public function getTypeContact(): ?string
    {
        return $this->typeContact;
    }

    public function setTypeContact(string $typeContact): self
    {
        $this->typeContact = $typeContact;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
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

    /**
     * @return Collection<int, Project>
     */
    public function getIdProject(): Collection
    {
        return $this->idProject;
    }

    public function addIdProject(Project $idProject): self
    {
        if (!$this->idProject->contains($idProject)) {
            $this->idProject[] = $idProject;
        }

        return $this;
    }

    public function removeIdProject(Project $idProject): self
    {
        $this->idProject->removeElement($idProject);

        return $this;
    }

}
