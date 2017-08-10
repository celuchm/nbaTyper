<?php

namespace scheduleIdentityManagerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class scheduleManagerControllerTest extends WebTestCase
{
    public function testManageschedule()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/manageSchedule');
    }

}
