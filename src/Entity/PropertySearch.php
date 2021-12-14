<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    private $minSurface;
    private $maxPrice;

    /**
     * @var ArrayCollection
     */
    private $options;

    function __construct()
    {
        $this->options = new ArrayCollection();
    }
    
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

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}