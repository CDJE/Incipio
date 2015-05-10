<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mandate.
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class Mandate
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
     * @var \DateTime
     *
     * @Iri("https://schema.org/startDate")
     * @ORM\Column(name="start_at", type="datetime")
     * @Assert\Date
     * @Assert\NotNull
     * @Groups({"user"})
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @Iri("https://schema.org/endDate")
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     * @Assert\Date
     * @Groups({"user"})
     */
    private $endAt;

    /**
     * @var ArrayCollection<Job> List of jobs attached to this mandate.
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="mandate")
     *
     * TODO: validation: may have no jobs but a job requires at least one mandate
     */
    private $jobs;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->jobs = new ArrayCollection();
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
     * Set startAt.
     *
     * @param \DateTime $startAt
     *
     * @return $this
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt.
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set endAt.
     *
     * @param \DateTime $endAt
     *
     * @return $this
     */
    public function setEndAt(\DateTime $endAt = null)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt.
     *
     * @return \DateTime|null
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Adds Job. Will automatically update job's mandate too.
     *
     * @param Job $job
     *
     * @return $this
     */
    public function addJob(Job $job)
    {
        if (false === $this->jobs->contains($job)) {
            $this->jobs->add($job);
        }
        $job->setMandate($this);

        return $this;
    }

    /**
     * Removes job. Will automatically update job's mandate too.
     *
     * @param Job $job
     *
     * @return $this
     */
    public function removeJob(Job $job)
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
            $job->setUser(null);
        }

        return $this;
    }

    /**
     * Gets Jobs.
     *
     * @return ArrayCollection<Job>
     */
    public function getJobs()
    {
        return $this->jobs;
    }
}
