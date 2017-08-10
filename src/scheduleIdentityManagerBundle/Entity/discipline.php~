<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\disciplineRepository")
 */
class discipline
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="disciplineName", type="string", length=255)
     */
    private $disciplineName;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set disciplineName
     *
     * @param string $disciplineName
     * @return discipline
     */
    public function setDisciplineName($disciplineName)
    {
        $this->disciplineName = $disciplineName;

        return $this;
    }

    /**
     * Get disciplineName
     *
     * @return string 
     */
    public function getDisciplineName()
    {
        return $this->disciplineName;
    }

    public function __toString() {
        return $this->getDisciplineName();
    }
}
