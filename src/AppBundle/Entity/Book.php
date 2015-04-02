<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A book.
 *
 * @see http://schema.org/Book Documentation on Schema.org
 *
 * @ORM\Entity
 */
class Book extends CreativeWork
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var ArrayCollection<Person> The illustrator of the book.
     *
     * @ORM\ManyToMany(targetEntity="Person")
     */
    private $illustrator;
    /**
     * @var string The ISBN of the book.
     *
     * @Assert\Type(type="string")
     * @ORM\Column(nullable=true)
     */
    private $isbn;
    /**
     * @var integer The number of pages in the book.
     *
     * @Assert\Type(type="integer")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPages;

    public function __construct()
    {
        parent::__construct();

        $this->illustrator = new ArrayCollection();
    }

    /**
     * Sets id.
     *
     * @param  integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Adds illustrator.
     *
     * @param  Person $illustrator
     * @return $this
     */
    public function addIllustrator(Person $illustrator)
    {
        $this->illustrator[] = $illustrator;

        return $this;
    }

    /**
     * Removes illustrator.
     *
     * @param  Person $illustrator
     * @return $this
     */
    public function removeIllustrator(Person $illustrator)
    {
        $key = array_search($illustrator, $this->illustrator, true);
        if (false !== $key) {
            unset($this->illustrator[$key]);
        }

        return $this;
    }

    /**
     * Gets illustrator.
     *
     * @return ArrayCollection<Person>
     */
    public function getIllustrator()
    {
        return $this->illustrator;
    }

    /**
     * Sets isbn.
     *
     * @param  string $isbn
     * @return $this
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Gets isbn.
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Sets numberOfPages.
     *
     * @param  integer $numberOfPages
     * @return $this
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;

        return $this;
    }

    /**
     * Gets numberOfPages.
     *
     * @return integer
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }
}
