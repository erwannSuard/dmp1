<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project", indexes={@ORM\Index(name="IDX_2FB3D0EEF3B54EC9", columns={"id_ref_project"}), @ORM\Index(name="IDX_2FB3D0EEDA89326", columns={"id_funding_project"})})
 * @ORM\Entity
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
     * @ORM\ManyToMany(targetEntity="Contact", mappedBy="idProject")
     */
    private $idContact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idContact = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
