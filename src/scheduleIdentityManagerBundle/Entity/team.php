<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\teamRepository")
 */
class team
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
     * @ORM\Column(name="teamName", type="string", length=50, nullable=true)
     */
    private $teamName;

    /**
     * @var string
     *
     * @ORM\Column(name="teamShortName", type="string", length=10)
     */
    private $teamShortName;


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
     * Set teamName
     *
     * @param string $teamName
     * @return team
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string 
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set teamShortName
     *
     * @param string $teamShortName
     * @return team
     */
    public function setTeamShortName($teamShortName)
    {
        $this->teamShortName = $teamShortName;

        return $this;
    }

    /**
     * Get teamShortName
     *
     * @return string 
     */
    public function getTeamShortName()
    {
        return $this->teamShortName;
    }
}
