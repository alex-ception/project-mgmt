<?php

namespace ProjectMgmt\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProjectMgmt\Bundle\Entity\BookRepository")
 */
class Book
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="ProjectMgmt\Bundle\Entity\Chapter", mappedBy="book")
     * @ORM\OrderBy({"order" = "asc"})
     */
    private $chapters;
    
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
     * Set name
     *
     * @param string $name
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chapters = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chapters
     *
     * @param \ProjectMgmt\Bundle\Entity\Chapter $chapters
     * @return Book
     */
    public function addChapter(\ProjectMgmt\Bundle\Entity\Chapter $chapters)
    {
        $this->chapters[] = $chapters;

        return $this;
    }

    /**
     * Remove chapters
     *
     * @param \ProjectMgmt\Bundle\Entity\Chapter $chapters
     */
    public function removeChapter(\ProjectMgmt\Bundle\Entity\Chapter $chapters)
    {
        $this->chapters->removeElement($chapters);
    }

    /**
     * Get chapters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChapters()
    {
        return $this->chapters;
    }
}
