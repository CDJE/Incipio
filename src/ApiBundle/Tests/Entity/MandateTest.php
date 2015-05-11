<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Entity\Job;
use ApiBundle\Entity\Mandate;

/**
 * Class MandateTest.
 *
 * @see    ApiBundle\Entity\Mandate
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class MandateTest extends EntityTestCaseAbstract
{
    /**
     * {@inheritdoc}
     *
     * @dataProvider fluentDataProvider
     */
    public function testPropertyAccessors(array $data = [])
    {
        $mandate = new Mandate();

        $mandate
            ->setStartAt($data['startAt'])
            ->setEndAt($data['endAt'])
            ->addJob($data['job'])
        ;

        // Test classic setters
        $this->assertEquals($data['startAt']->format('Y-m-d'), $mandate->getStartAt()->format('Y-m-d'));
        $this->assertEquals($data['endAt']->format('Y-m-d'), $mandate->getEndAt()->format('Y-m-d'));
        $this->assertTrue($mandate->getJobs()->contains($data['job']));

        // Test if relations has been properly set
        $this->assertEquals($mandate, $data['job']->getMandate());


        // Test if properties and relations can be reset
        $mandate
            ->setEndAt(null)
            ->removeJob($data['job'])
        ;
        try {
            $mandate->setStartAt(null);
        } catch (\Exception $e) {
            // Expect error thrown
        }

        $this->assertEquals(null, $mandate->getEndAt());
        $this->assertFalse($mandate->getJobs()->contains($data['job']));

        $this->assertEquals(null, $data['job']->getMandate());


        // Test if resetting non existing relations does not cause any error
        $mandate
            ->setEndAt(null)
            ->removeJob($data['job'])
        ;
        $this->assertEquals(null, $mandate->getEndAt());
        $this->assertFalse($mandate->getJobs()->contains($data['job']));
    }

    /**
     * Provides an optimal set of data for generating a complete entity.
     */
    public function fluentDataProvider()
    {
        return [
            [
                [
                    'startAt' => new \DateTime('2015-03-02'),
                    'endAt' => new \DateTime('2016-03-02'),
                    'job' => new Job()
                ],
            ],
        ];
    }
}
