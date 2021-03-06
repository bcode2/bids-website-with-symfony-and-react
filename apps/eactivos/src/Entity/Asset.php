<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 * @ORM\Entity
 * @ORM\Table(name="asset")
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
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
     * @ORM\Column(name="name", type="string", length=180)
     */
    private $name;

    /**
     * @ORM\Column(name="price",type="decimal", scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=280)
     */
    private $description;

    /**
     * @var DateTime
     * @ORM\Column(name="endDate",type="datetime")
     */
    private $endDate;

    /**
     * @var Collection|Bid[]
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="asset", cascade={"persist", "remove"})
     */
    private $bids;

    private $highestBid = null;

    private $bestBid = null;

    /**
     * @return null
     */
    public function getBestBid()
    {
        if ($this->bids->count() === 0) {
            return null;
        }

        $bestBid = null;
        $bestBidPrice = 0;
        $bidArray = $this->getBids();


        foreach ($bidArray as $bid) {
            $tempBidAmount = $bid->getBidAmount();
            if ($tempBidAmount >= $bestBidPrice) {
                $bestBid = $bid;
                $bestBidPrice = $tempBidAmount;
            }
        }

        return $bestBid;
    }

    /**
     * @return mixed
     */
    public function getHighestBid()
    {
        if ($this->bids->count() === 0) {
            return null;
        }

        $BidsPrices = [];
        $bidArray = $this->getBids()->toArray();
        foreach ($bidArray as $bid) {
            $BidsPrices[] = $bid->getBidAmount();
        }

        return max($BidsPrices);
    }

    public function __construct()
    {
        $this->bids = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * @param mixed $bids
     */
    public function setBids($bids): void
    {
        $this->bids = $bids;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Asset
     */
    public function setName(string $name): Asset
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set price.
     *
     * @param string $price
     *
     * @return Asset
     */
    public function setPrice(string $price): Asset
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }
}
