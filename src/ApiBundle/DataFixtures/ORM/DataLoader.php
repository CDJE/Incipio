<?php

namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\DataFixtures\Faker\Provider\UserProvider;
use ApiBundle\DataFixtures\Faker\Provider\JobProvider;
use ApiBundle\DataFixtures\Faker\Provider\MandateProvider;
use Doctrine\Common\Persistence\ObjectManager;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Class DataLoader: register faker providers and load registered fixtures.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class DataLoader extends DataFixtureLoader
{
    /**
     * {inheritDoc}.
     *
     * TODO: do not override this method. This is done as a temporary measure for adding custom providers. To check
     * the updates on the subject, check the following link.
     *
     * @link https://github.com/hautelook/AliceBundle/issues/46
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        /** @var $loader \Hautelook\AliceBundle\Alice\Loader */
        $loader = $this->container->get('hautelook_alice.loader');
        $loader->setObjectManager($manager);
        //TODO: changed line
        $loader->setProviders($this->getProviders());

        foreach ($this->getProcessors() as $processor) {
            $loader->addProcessor($processor);
        }

        $loader->load($this->getFixtures());

        return $loader->getReferences();
    }

    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return [
            __DIR__.'/job.yml',
            __DIR__.'/mandate.yml',
            __DIR__.'/user.yml',
        ];
    }

    /**
     * @return array List of Faker providers.
     */
    protected function getProviders()
    {
        //TODO: change this faker instance to used the real one instead (which loads locales form config)
        $faker = \Faker\Factory::create();

        return [
            $this,
            new JobProvider($faker),
            new MandateProvider($faker),
            new UserProvider($faker, $this->container->get('api.user.roles')),
        ];
    }
}
