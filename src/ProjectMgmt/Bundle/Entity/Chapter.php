<?php

namespace ProjectMgmt\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chapter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProjectMgmt\Bundle\Entity\ChapterRepository")
 */
class Chapter
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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=45, nullable=true)
     */
    private $author;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=true)
     */
    private $order;
    
     /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="ProjectMgmt\Bundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bookid", referencedColumnName="id")
     * })
     */
    private $book;

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
     * @return Chapter
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
     * Set author
     *
     * @param string $author
     * @return Chapter
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Chapter
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set book
     *
     * @param \ProjectMgmt\Bundle\Entity\Book $book
     * @return Chapter
     */
    public function setBook(\ProjectMgmt\Bundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \ProjectMgmt\Bundle\Entity\Book 
     */
    public function getBook()
    {
        return $this->book;
    }
}
