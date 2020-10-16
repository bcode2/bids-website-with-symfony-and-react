<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bid
 * @ORM\Entity
 * @ORM\Table(name="bid")
 * @ORM\Entity(repositoryClass="App\Repository\BidRepository")
 */
class Bid
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
     * @var Asset
     * @ORM\ManyToOne(targetEntity="Asset",inversedBy="bids")
     */
    private $asset;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="bids")
     */
    private $user;

    /**
     * @var DateTime
     * @ORM\Column(name="effectDate",type="datetime")
     */
    private $effectDate;

    /**
     * @ORM\Column(name="bidAmount",type="decimal", scale=2)
     */
    private $bidAmount;

    /**
     * @return mixed
     */
    public function getBidAmount()
    {
        return $this->bidAmount;
    }

    /**
     * @param mixed $bidAmount
     */
    public function setBidAmount($bidAmount)
    {
        $this->bidAmount = $bidAmount;
    }

    /**
     * @return DateTime
     */
    public function getEffectDate(): DateTime
    {
        return $this->effectDate;
    }

    /**
     */
    public function setEffectDate()
    {
        $this->effectDate = new DateTime();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @param Asset $asset
     */
    public function setAsset(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
