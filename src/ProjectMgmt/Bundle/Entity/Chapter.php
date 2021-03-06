<?php

namespace ProjectMgmt\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;
use ProjectMgmt\Bundle\Entity\User;

/**
 * Chapter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProjectMgmt\Bundle\Entity\ChapterRepository")
 * @Serialize\ExclusionPolicy("all")
 */
class Chapter {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @Assert\NotBlank
     * @Serialize\Expose()
     */
    private $name;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="ProjectMgmt\Bundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="id")
     * })
     * @Serialize\Expose()
     *
     */
    private $author;
    
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     * @Assert\NotBlank
     * @Serialize\Expose()
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     * @Serialize\Expose()
     */
    private $order;

    /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="ProjectMgmt\Bundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book", referencedColumnName="id")
     * })
     */
    private $book;

    public function __construct()
    {
        $this->content = 'Contenu du chapitre';
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Chapter
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Chapter
     */
    public function setOrder($order) {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * Set book
     *
     * @param \ProjectMgmt\Bundle\Entity\Book $book
     * @return Chapter
     */
    public function setBook(\ProjectMgmt\Bundle\Entity\Book $book = null) {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \ProjectMgmt\Bundle\Entity\Book 
     */
    public function getBook() {
        return $this->book;
    }


    /**
     * Set author
     *
     * @param \ProjectMgmt\Bundle\Entity\User $author
     * @return Chapter
     */
    public function setAuthor(\ProjectMgmt\Bundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \ProjectMgmt\Bundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Chapter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
