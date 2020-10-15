<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 * @ORM\Entity
 * @ORM\Table(name="bid")
 * @ORM\Entity(repositoryClass="App\Repository\BidRepository")
 */
class Bid
{
    public function setUser()
    {
    }

    public function setPrice($randomFloat)
    {
    }

    public function setAsset($getRandomReference)
    {
    }
}
