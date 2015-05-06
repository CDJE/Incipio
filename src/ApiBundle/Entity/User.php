<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User: user that have an account in the application.
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class User extends BaseUser
{
    /*
     * Hook timestampable behavior: updates `createdAt` and `updatedAt fields
     */
    use TimestampableEntity;

    /**
     * {@inheritdoc}
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"user"})
     */
    protected $id;

    /**
     * {@inheritdoc}
     *
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Groups({"user"})
     *
     * @TODO: validation for username!
     */
    protected $username;

    /**
     * {@inheritdoc}
     *
     * @Assert\Email
     * @Assert\NotBlank
     * @Groups({"user"})
     */
    protected $email;

    /**
     * {@inheritdoc}
     *
     * @Assert\Length(
     *      min="8",
     *      max="32"
     * )
     * @Assert\NotBlank
     *
     * @TODO: validation for the password!
     */
    protected $password;

    /**
     * {@inheritdoc}
     *
     * @Groups({"user"})
     */
    protected $roles;

    /**
     * @var ArrayCollection<Job> List of job for this mandate.
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Job", mappedBy="user")
     * @Groups({"user"})
     *
     * @TODO: validation: may have no user
     **/
    protected $jobs;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->jobs = new ArrayCollection();
    }

    /**
     * Adds Job. Will automatically update job's user too.
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
        $job->setUser($this);

        return $this;
    }

    /**
     * Removes job. Will automatically update job's user too.
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
