<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use scheduleIdentityManagerBundle\Entity\discipline;
use scheduleIdentityManagerBundle\Entity\season;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * league
 *
 * @ORM\Table(name="league")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\leagueRepository")
 */
class league
{

    public function __construct(){
        $this->seasons = new ArrayCollection();
    }

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
     * @ORM\Column(name="leagueName", type="string", length=255)
     */
    private $leagueName;

    /**
     * @var integer
     *
     * @ORM\Column(name="discipline", type="integer")
     * @ORM\ManyToOne(targetEntity="discipline")
     * @ORM\JoinColumn(name="discipline", referencedColumnName="id")
     */
    private $discipline;


    /**
     * @ORM\OneToMany(targetEntity="season", mappedBy="league")
     */
    private $seasons;

    /**
     * @var string
     *
     * @ORM\Column(name="leagueType", type="string", length=255)
     */
    private $leagueType;

    /**
     * @var string
     *
     * @ORM\Column(name="leagueStatus", type="string", length=255)
     */
    private $leagueStatus;

    /**
     * @var bool
     *
     * @ORM\Column(name="ifTournament", type="boolean")
     */
    private $ifTournament;

    /**
     * @var bool
     *
     * @ORM\Column(name="ifPlayoffs", type="boolean")
     */
    private $ifPlayoffs;


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
     * Set leagueName
     *
     * @param string $leagueName
     * @return league
     */
    public function setLeagueName($leagueName)
    {
        $this->leagueName = $leagueName;

        return $this;
    }

    /**
     * Get leagueName
     *
     * @return string 
     */
    public function getLeagueName()
    {
        return $this->leagueName;
    }

    /**
     * Set leagueType
     *
     * @param string $leagueType
     * @return league
     */
    public function setLeagueType($leagueType)
    {
        $this->leagueType = $leagueType;

        return $this;
    }

    /**
     * Get leagueType
     *
     * @return string 
     */
    public function getLeagueType()
    {
        return $this->leagueType;
    }

    /**
     * Set leagueStatus
     *
     * @param string $leagueStatus
     * @return league
     */
    public function setLeagueStatus($leagueStatus)
    {
        $this->leagueStatus = $leagueStatus;

        return $this;
    }

    /**
     * Get leagueStatus
     *
     * @return string 
     */
    public function getLeagueStatus()
    {
        return $this->leagueStatus;
    }

    /**
     * Set ifTournament
     *
     * @param boolean $ifTournament
     * @return league
     */
    public function setIfTournament($ifTournament)
    {
        $this->ifTournament = $ifTournament;

        return $this;
    }

    /**
     * Get ifTournament
     *
     * @return boolean 
     */
    public function getIfTournament()
    {
        return $this->ifTournament;
    }

    /**
     * Set ifPlayoffs
     *
     * @param boolean $ifPlayoffs
     * @return league
     */
    public function setIfPlayoffs($ifPlayoffs)
    {
        $this->ifPlayoffs = $ifPlayoffs;

        return $this;
    }

    /**
     * Get ifPlayoffs
     *
     * @return boolean 
     */
    public function getIfPlayoffs()
    {
        return $this->ifPlayoffs;
    }





    /**
     * Add seasons
     *
     * @param \scheduleIdentityManagerBundle\Entity\season $seasons
     * @return league
     */
    public function addSeason(\scheduleIdentityManagerBundle\Entity\season $seasons)
    {
        $this->seasons[] = $seasons;

        return $this;
    }

    /**
     * Remove seasons
     *
     * @param \scheduleIdentityManagerBundle\Entity\season $seasons
     */
    public function removeSeason(\scheduleIdentityManagerBundle\Entity\season $seasons)
    {
        $this->seasons->removeElement($seasons);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

   




    /**
     * Set discipline
     *
     * @param integer $discipline
     * @return league
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;

        return $this;
    }

    /**
     * Get discipline
     *
     * @return integer 
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }
}
