<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * seasonTeams
 *
 * @ORM\Table(name="season_teams")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\seasonTeamsRepository")
 */
class seasonTeams
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
     * @var int
     * @ORM\ManyToOne(targetEntity="season")
     * @ORM\JoinColumn(name="seasonId",	referencedColumnName="id")
     * @ORM\Column(name="seasonId", type="integer")
     */
    private $seasonId;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="team")
     * @ORM\JoinColumn(name="teamId",referencedColumnName="id")
     * @ORM\Column(name="teamId", type="integer")
     */
    private $teamId;


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
     * Set seasonId
     *
     * @param string $seasonId
     * @return seasonTeams
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;

        return $this;
    }

    /**
     * Get seasonId
     *
     * @return string 
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set teamId
     *
     * @param integer $teamId
     * @return seasonTeams
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->teamId;
    }
}
