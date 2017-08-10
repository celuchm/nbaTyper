<?php

namespace scheduleIdentityManagerBundle\Controller;


use scheduleIdentityManagerBundle\Entity\discipline;
use scheduleIdentityManagerBundle\Entity\league;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * League controller.
 *
 * @Route("league")
 */

class leagueController extends Controller{

    /**
     * Lists all leagues
     *
     * @Route("/index/{disciplineName}", name="league_index")
     * @Method("GET")
     */

    public function indexAction($disciplineName){
        $em = $this->getDoctrine()->getManager();
        $disciplineId = $em->getRepository('scheduleIdentityManagerBundle:discipline')->findOneBy(array(
            'disciplineName' => $disciplineName))->getId();
        $leagues = $em->getRepository('scheduleIdentityManagerBundle:league')->findBy(array(
            'discipline' => $disciplineId,
            'leagueStatus' => 'open'));

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:leagueIndex.html.twig', array(
            'leagues' => $leagues,
            'discipline' => $disciplineName
        ));
    }


    /**
     * @Route("/new", name="league_new")
     * @Method({"POST", "GET"})
     */
    public function newLeagueAction(Request $request)    {
        //--------------------------------
        $league = new League();
        $em = $this->getDoctrine()->getManager();
        $disciplinesRepository = $em->getRepository('scheduleIdentityManagerBundle:discipline');
        //--------------------------------

        //------generate options to Form disciplineId -> disciplineName
        $disciplinesAll = $disciplinesRepository->findAll();
        $disciplines = array();
        foreach($disciplinesAll as $discipline ){
            $disciplines[$discipline->getId()] = $discipline->getDisciplineName();
        }
        $formOptions = array('disciplines' => $disciplines);
        //-------end form options



        $form = $this->createForm('scheduleIdentityManagerBundle\Form\leagueType', $league, $formOptions);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($league);
            $em->flush();
            $disciplineName = $disciplinesRepository->findOneBy(array(
                'id' => $league->getDiscipline()));
            return $this->redirectToRoute('league_index', array(
                'discipline' => $disciplineName,
                'ligueId' => $league->getId()));
        }

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:disciplineNew.html.twig', array(
            'form' => $form->createView()
        ));
    } //end new league action


    /**
     * @Route("/close/{leagueId}", name="league_close")
     * @Method({"POST", "GET"})
     */
    public function closeLeagueAction($leagueId){

        $em = $this->getDoctrine()->getManager();

        $leagueToClose = $em->getRepository('scheduleIdentityManagerBundle:league')->findOneBy(array(
            'id' => $leagueId));

        $leagueToClose->setLeagueStatus('close');
        $leagueId = $leagueToClose->getDiscipline();
        $em->persist($leagueToClose);
        $em->flush();

        $disciplineName = $em->getRepository('scheduleIdentityManagerBundle:discipline')->findOneBy(array(
            'id' => $leagueId))->getDisciplineName();

        $response = $this->forward('scheduleIdentityManagerBundle:league:index', array(
            'disciplineName'=>$disciplineName
        ));
        return $response;

    }

    /**
     * @Route("/seasons/{leagueId}", name="league_seasons")
     * @Method({"GET"})
     */
    public function showLeagueSeasonsAction($leagueId){
        $em = $this->getDoctrine()->getManager();

        $league = $em->getRepository('scheduleIdentityManagerBundle:league')->findOneBy(array(
            'id' => $leagueId));

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:seasonIndex.html.twig', array(
            'leaguId' => $league->getId(),
            'seasons' => $league->getSeasons()
        ));

    }

}
