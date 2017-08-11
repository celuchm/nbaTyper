<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * roundGame
 *
 * @ORM\Table(name="round_game")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\roundGameRepository")
 */
class roundGame
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
     *
     * @ORM\Column(name="roundId", type="integer")
     * @ORM\ManyToOne(targetEntity="round", inversedBy="roundGames")
     * @ORM\JoinColumn(name="roundId", referencedColumnName="id")
     */
    private $roundId;

    /**
     * @var int
     *
     * @ORM\Column(name="teamHomeId", type="integer")
     */
    private $teamHomeId;

    /**
     * @var string
     *
     * @ORM\Column(name="teamAwayId", type="integer")
     */
    private $teamAwayId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStartCET", type="time")
     */
    private $timeStartCET;

    /**
     * @var string
     *
     * @ORM\Column(name="gameStatus", type="string", length=255, nullable = true)
     */
    private $gameStatus;

    /**
     * @var float
     *
     * @ORM\Column(name="scoreHome", type="float",  nullable = true)
     */
    private $scoreHome;

    /**
     * @var float
     *
     * @ORM\Column(name="scoreAway", type="float",  nullable = true)
     */
    private $scoreAway;


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
     * Set roundId
     *
     * @param integer $roundId
     * @return roundGame
     */
    public function setRoundId($roundId)
    {
        $this->roundId = $roundId;

        return $this;
    }

    /**
     * Get roundId
     *
     * @return integer 
     */
    public function getRoundId()
    {
        return $this->roundId;
    }

    /**
     * Set teamHomeId
     *
     * @param integer $teamHomeId
     * @return roundGame
     */
    public function setTeamHomeId($teamHomeId)
    {
        $this->teamHomeId = $teamHomeId;

        return $this;
    }

    /**
     * Get teamHomeId
     *
     * @return integer 
     */
    public function getTeamHomeId()
    {
        return $this->teamHomeId;
    }

    /**
     * Set teamAwayId
     *
     * @param string $teamAwayId
     * @return roundGame
     */
    public function setTeamAwayId($teamAwayId)
    {
        $this->teamAwayId = $teamAwayId;

        return $this;
    }

    /**
     * Get teamAwayId
     *
     * @return string 
     */
    public function getTeamAwayId()
    {
        return $this->teamAwayId;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return roundGame
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set timeStartCET
     *
     * @param \DateTime $timeStartCET
     * @return roundGame
     */
    public function setTimeStartCET($timeStartCET)
    {
        $this->timeStartCET = $timeStartCET;

        return $this;
    }

    /**
     * Get timeStartCET
     *
     * @return \DateTime 
     */
    public function getTimeStartCET()
    {
        return $this->timeStartCET;
    }

    /**
     * Set gameStatus
     *
     * @param string $gameStatus
     * @return roundGame
     */
    public function setGameStatus($gameStatus)
    {
        $this->gameStatus = $gameStatus;

        return $this;
    }

    /**
     * Get gameStatus
     *
     * @return string 
     */
    public function getGameStatus()
    {
        return $this->gameStatus;
    }

    /**
     * Set scoreHome
     *
     * @param float $scoreHome
     * @return roundGame
     */
    public function setScoreHome($scoreHome)
    {
        $this->scoreHome = $scoreHome;

        return $this;
    }

    /**
     * Get scoreHome
     *
     * @return float 
     */
    public function getScoreHome()
    {
        return $this->scoreHome;
    }

    /**
     * Set scoreAway
     *
     * @param float $scoreAway
     * @return roundGame
     */
    public function setScoreAway($scoreAway)
    {
        $this->scoreAway = $scoreAway;

        return $this;
    }

    /**
     * Get scoreAway
     *
     * @return float 
     */
    public function getScoreAway()
    {
        return $this->scoreAway;
    }
}
