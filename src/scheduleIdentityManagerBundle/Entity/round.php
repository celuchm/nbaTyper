<?php

namespace scheduleIdentityManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * round
 *
 * @ORM\Table(name="round")
 * @ORM\Entity(repositoryClass="scheduleIdentityManagerBundle\Repository\roundRepository")
 */
class round
{
    public function __construct(){
        $this->roundGames = new ArrayCollection();
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
     * @ORM\Column(name="roundType", type="string", length=255)
     */
    private $roundType;

    /**
     * @ORM\OneToMany(targetEntity="roundGame", mappedBy="roundId")
     */
    private $roundGames;

    /**
     * @var int
     *
     * @ORM\Column(name="seasonId", type="integer",  nullable = true)
     * @ORM\ManyToOne(targetEntity="season", inversedBy="rounds")
     * @ORM\JoinColumn(name="seasonId", referencedColumnName="id")
     */
    private $seasonId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date",  nullable = true)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date", nullable = true)
     */
    private $dateEnd;


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
     * Set roundType
     *
     * @param string $roundType
     * @return round
     */
    public function setRoundType($roundType)
    {
        $this->roundType = $roundType;

        return $this;
    }

    /**
     * Get roundType
     *
     * @return string 
     */
    public function getRoundType()
    {
        return $this->roundType;
    }

    /**
     * Set seasonId
     *
     * @param integer $seasonId
     * @return round
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;

        return $this;
    }

    /**
     * Get seasonId
     *
     * @return integer 
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return round
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
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return round
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add roundGames
     *
     * @param \scheduleIdentityManagerBundle\Entity\roundGame $roundGames
     * @return round
     */
    public function addRoundGame(\scheduleIdentityManagerBundle\Entity\roundGame $roundGames)
    {
        $this->roundGames[] = $roundGames;

        return $this;
    }

    /**
     * Remove roundGames
     *
     * @param \scheduleIdentityManagerBundle\Entity\roundGame $roundGames
     */
    public function removeRoundGame(\scheduleIdentityManagerBundle\Entity\roundGame $roundGames)
    {
        $this->roundGames->removeElement($roundGames);
    }

    /**
     * Get roundGames
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoundGames()
    {
        return $this->roundGames;
    }
}
