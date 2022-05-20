<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Romp
 *
 * @ORM\Table(name="romp", indexes={@ORM\Index(name="IDX_23AF5FC039FFE2AA", columns={"id_project_romp"}), @ORM\Index(name="IDX_23AF5FC02891A84D", columns={"id_contact_romp"})})
 * @ORM\Entity
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


}
