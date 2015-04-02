<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 *
 * @see http://schema.org/CreativeWork Documentation on Schema.org
 *
 * @ORM\MappedSuperclass
 */
abstract class CreativeWork extends Thing
{
    /**
     * @var ArrayCollection<Person> The author of this content. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
     *
     * @ORM\ManyToMany(targetEntity="Person")
     */
    private $author;
    /**
     * @var \DateTime Date of first broadcast/publication.
     *
     * @Assert\Date
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePublished;
    /**
     * @var string Genre of the creative work or group.
     *
     * @Assert\Type(type="string")
     * @ORM\Column(nullable=true)
     */
    private $genre;
    /**
     * @var Organization The publisher of the creative work.
     *
     * @ORM\OneToOne(targetEntity="Organization")
     */
    private $publisher;

    public function __construct()
    {
        $this->author = new ArrayCollection();
    }

    /**
     * Adds author.
     *
     * @param  Person $author
     * @return $this
     */
    public function addAuthor(Person $author)
    {
        $this->author[] = $author;

        return $this;
    }

    /**
     * Removes author.
     *
     * @param  Person $author
     * @return $this
     */
    public function removeAuthor(Person $author)
    {
        $key = array_search($author, $this->author, true);
        if (false !== $key) {
            unset($this->author[$key]);
        }

        return $this;
    }

    /**
     * Gets author.
     *
     * @return ArrayCollection<Person>
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets datePublished.
     *
     * @param  \DateTime $datePublished
     * @return $this
     */
    public function setDatePublished(\DateTime $datePublished = null)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Gets datePublished.
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Sets genre.
     *
     * @param  string $genre
     * @return $this
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Gets genre.
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Sets publisher.
     *
     * @param  Organization $publisher
     * @return $this
     */
    public function setPublisher(Organization $publisher = null)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Gets publisher.
     *
     * @return Organization
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
}
