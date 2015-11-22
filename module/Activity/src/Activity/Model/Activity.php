<?php

namespace Activity\Model;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use User\Model\User;

/**
 * Activity model.
 *
 * @ORM\Entity
 */
class Activity
{
    /**
     * Status codes for the activity
     */
    const STATUS_TO_APPROVE = 1; // Activity needs to be approved
    const STATUS_APPROVED = 2;  // The activity is approved
    const STATUS_DISAPPROVED = 3; // The board disapproved the activity

    /**
     * ID for the activity.
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Name for the activity.
     *
     * @Orm\Column(type="string")
     */
    protected $name;

    /**
     * English name for the activity
     *
     * @Orm\Column(type="string")
     */
    protected $name_en;

    /**
     * The date and time the activity starts.
     *
     * @ORM\Column(type="datetime")
     */
    protected $beginTime;

    /**
     * The date and time the activity ends.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endTime;

    /**
     * The location the activity is held at.
     *
     * @ORM\Column(type="string")
     */
    protected $location;

    /**
     * English string to denote what location the activity is held on
     *
     * @ORM\Column(type="string")
     */
    protected $location_en;

    /**
     * How much does it cost.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $costs;

    /**
     * English string to denote how much the activity cost
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $costs_en;

    /**
     * Are people able to sign up for this activity?
     *
     * @ORM\Column(type="boolean")
     */
    protected $canSignUp;

    /**
     * Are people outside of GEWIS allowed to sign up
     * N.b. if $canSignUp is false, this column does not matter.
     *
     * @ORM\Column(type="boolean")
     */
    protected $onlyGEWIS;

    /**
     * Who did approve this activity.
     *
     * @ORM\ManyToOne(targetEntity="User\Model\User")
     * @ORM\JoinColumn(referencedColumnName="lidnr")
     */
    protected $approver;

    /**
     * Who created this activity.
     *
     * @ORM\Column(nullable=false)
     * @ORM\ManyToOne(targetEntity="User\Model\User")
     * @ORM\JoinColumn(referencedColumnName="lidnr")
     */
    protected $creator;

    /**
     * What is the approval status      .
     *
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * Activity description.
     *
     * @Orm\Column(type="text")
     */
    protected $description;

    /**
     * Activity description.
     *
     * @Orm\Column(type="text")
     */
    protected $description_en;

    /**
     * all the people who signed up for this activity
     *
     * @ORM\OneToMany(targetEntity="ActivitySignup", mappedBy="activity")
     */
    protected $signUps;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param string $name_en
     */
    public function setNameEn($name_en)
    {
        $this->name_en = $name_en;
    }

    /**
     * @return DateTime
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * @param DateTime $beginTime
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
    }

    /**
     * @return DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param DateTime $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocationEn()
    {
        return $this->location_en;
    }

    /**
     * @param string $location_en
     */
    public function setLocationEn($location_en)
    {
        $this->location_en = $location_en;
    }

    /**
     * @return string
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param string $costs
     */
    public function setCosts($costs)
    {
        $this->costs = $costs;
    }

    /**
     * @return string
     */
    public function getCostsEn()
    {
        return $this->costs_en;
    }

    /**
     * @param string $costs_en
     */
    public function setCostsEn($costs_en)
    {
        $this->costs_en = $costs_en;
    }

    /**
     * @return boolean
     */
    public function getCanSignUp()
    {
        return $this->canSignUp;
    }

    /**
     * @param boolean $canSignUp
     */
    public function setCanSignUp($canSignUp)
    {
        $this->canSignUp = $canSignUp;
    }

    /**
     * @return boolean
     */
    public function getOnlyGEWIS()
    {
        return $this->onlyGEWIS;
    }

    /**
     * @param boolean $onlyGEWIS
     */
    public function setOnlyGEWIS($onlyGEWIS)
    {
        $this->onlyGEWIS = $onlyGEWIS;
    }

    /**
     * @return User
     */
    public function getApprover()
    {
        return $this->approver;
    }

    /**
     * @param User $approver
     */
    public function setApprover(User $approver)
    {
        $this->approver = $approver;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * @param string $description_en
     */
    public function setDescriptionEn($description_en)
    {
        $this->description_en = $description_en;
    }

    /**
     * @return array
     */
    public function getSignUps()
    {
        return $this->signUps;
    }

    /**
     * @param array $signUps
     */
    public function setSignUps($signUps)
    {
        $this->signUps = $signUps;
    }
}
