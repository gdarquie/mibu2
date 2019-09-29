<?php


namespace App\Entity;

/**
 * Trait SluggableEntityTrait
 * @package App\Entity
 */
trait SluggableEntityTrait
{
    /**
     * @ORM\Column(length=16)
     */
    private $code;

    /**
     * @Gedmo\Slug(fields={"code"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }
}