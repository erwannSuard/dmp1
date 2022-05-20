<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contact_id_contact_seq", allocationSize=1, initialValue=1)
     */
    private $idContact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_contact", type="string", nullable=true)
     */
    private $typeContact;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
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
     * @ORM\Column(name="identifier", type="string", length=50, nullable=true)
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

}
