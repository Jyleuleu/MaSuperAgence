<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    private $minSurface;
    private $maxPrice;
    
    /**
     * Get the value of min_surface
     * @Assert\Range(min=10, max=400)
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set the value of min_surface
     *
     * @return  self
     */ 
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of max_price
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of max_price
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}