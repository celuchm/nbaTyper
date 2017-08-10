<?php

namespace scheduleIdentityManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class scheduleManagerController extends Controller
{
    /**
     * @Route("/manageSchedule")
     */
    public function manageScheduleAction()
    {
        return $this->render('scheduleIdentityManagerBundle:scheduleManager:manage_schedule.html.twig', array(
            // ...
        ));
    }

}
