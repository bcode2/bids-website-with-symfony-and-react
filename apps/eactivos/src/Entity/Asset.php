<?php

namespace App\Entity;

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
    public $name;


    /**
     * @ORM\Column(name="price",type="decimal", scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=280)
     */
    public $description;

    /**
     * @var DateTime
     * @ORM\Column(name="endDate",type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=100,options={"default" :"assetDefault.jpg"})
     */
    private $img;

    /**
     * *  One Asset  will have one  category
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="assets")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @return integer
     */
    private $category;

    /**
     *
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="asset")
     */
    private $bids;

    /**
     * Get assets
     *
     * @return Collection
     */
    public function getassets()
    {
        return $this->assets;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
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
    public function setPrice($price): Asset
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * Set category.
     *
     * @param \App\Entity\Category|null $category
     *
     * @return Asset
     */
    public function setCategory(Category $category): Asset
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
