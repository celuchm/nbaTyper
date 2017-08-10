<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use scheduleIdentityManagerBundle\Entity\league;
use Doctrine\ORM\Mapping as ORM;

/**
 * season
 *
 * @ORM\Table(name="season")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\seasonRepository")
 */
class season
{
    public function __construct(){
        $this->rounds = new ArrayCollection();
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
     * @var int
     * @ORM\ManyToOne(targetEntity="league", inversedBy="seasons")
     * @ORM\JoinColumn(name="league", referencedColumnName="id")
     */
    private $league;


    /**
     * @ORM\OneToMany(targetEntity="round", mappedBy="roundId")
     */
    private $rounds;

    /**
     * @var int
     *
     * @ORM\Column(name="seasonStartDate", type="date")
     */
    private $seasonStartDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="seasonEndDate", type="date", nullable=true)
     */
    private $seasonEndDate;

    /**
     * @ORM\Column(name="seasonType", type="string")
     */
    private $seasonType;


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
     * Set seasonEndYear
     *
     * @param boolean $seasonEndYear
     * @return season
     */
    public function setSeasonEndDate($seasonEndDate)
    {
        $this->seasonEndDate = $seasonEndDate;

        return $this;
    }

    /**
     * Get ifTurnOfYears
     *
     * @return boolean 
     */
    public function getSeasonEndDate()
    {
        return $this->seasonEndDate;
    }

    /**
     * Add rounds
     *
     * @param \scheduleIdentityManagerBundle\Entity\round $rounds
     * @return season
     */
    public function addRound(\scheduleIdentityManagerBundle\Entity\round $rounds)
    {
        $this->rounds[] = $rounds;

        return $this;
    }

    /**
     * Remove rounds
     *
     * @param \scheduleIdentityManagerBundle\Entity\round $rounds
     */
    public function removeRound(\scheduleIdentityManagerBundle\Entity\round $rounds)
    {
        $this->rounds->removeElement($rounds);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Set league
     *
     * @param string $league
     * @return season
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return string 
     */
    public function getLeague()
    {
        return $this->league;
    }



    /**
     * Set seasonYears
     *
     * @param string $seasonStartYear
     * @return season
     */
    public function setSeasonStartYear($seasonStartYear)
    {
        $this->seasonStartYear = $seasonStartYear;

        return $this;
    }

    /**
     * Get seasonYears
     *
     * @return string 
     */
    public function getSeasonStartYear()
    {
        return $this->seasonStartYear;
    }

    /**
     * Set seasonStartDate
     *
     * @param \DateTime $seasonStartDate
     * @return season
     */
    public function setSeasonStartDate($seasonStartDate)
    {
        $this->seasonStartDate = $seasonStartDate;

        return $this;
    }

    /**
     * Get seasonStartDate
     *
     * @return \DateTime 
     */
    public function getSeasonStartDate()
    {
        return $this->seasonStartDate;
    }

    /**
     * Set seasonType
     *
     * @param string $seasonType
     * @return season
     */
    public function setSeasonType($seasonType)
    {
        $this->seasonType = $seasonType;

        return $this;
    }

    /**
     * Get seasonType
     *
     * @return string 
     */
    public function getSeasonType()
    {
        return $this->seasonType;
    }
}
