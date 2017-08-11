<?php

namespace scheduleIdentityManagerBundle\Controller;

use scheduleIdentityManagerBundle\Entity\discipline;
use scheduleIdentityManagerBundle\Entity\team;
use scheduleIdentityManagerBundle\Entity\season;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


/**
 * Season controller.
 *
 * @Route("season")
 */

class seasonController extends Controller{
    /**
     * Lists all seasons per league
     *
     * @Route("/index/{league}", name="season_index")
     * @Method("GET")
     */

    public function indexAction($league){
        $em = $this->getDoctrine()->getManager();
        $seasons = $em->getRepository('scheduleIdentityManagerBundle:season')->findBy(array('league' => $league));
        return $this->render('scheduleIdentityManagerBundle:scheduleManager:seasonIndex.html.twig', array(
            'seasons' => $seasons,
            'discipline' => $league
        ));
    }

    /**
     * @Route("/manage", name="seasonManager")
     */
    public function seasonManagerAction(Request $request){

    }

    /**
     * @Route("/teams/{seasonId}", name="seasonTeams")
     */
    public function showSeasonTeamsAction(Request $request, $seasonId){

        $em = $this->getDoctrine()->getManager();
        //$query = $em->createQuery("Select t.team_short from teams t");
        $count = $em->createQuery("Select count(st) from scheduleIdentityManagerBundle:seasonTeams st where st.seasonId = :seasonId")->setParameter("seasonId", $seasonId)
        ->getSingleScalarResult();

        $query = $em->createQuery("Select t.id, t.teamShortName from scheduleIdentityManagerBundle:seasonTeams st join scheduleIdentityManagerBundle:team t where t.id = st.teamId and st.seasonId = :seasonId");
        $query->setParameter("seasonId", $seasonId)->setHint('knp_paginator.count', $count);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            10,
            array('distinct' => false)
        );
        return $this->render('scheduleIdentityManagerBundle:scheduleManager:showTeams.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/uploadCallendarCsvForm/{seasonId}", name="uploadCsvCalendarForm")
     * @Method({"POST", "GET"})
     */
    public function uploadCsvCalendarAction(Request $request, $seasonId){
        $em = $this->getDoctrine()->getManager();
        $seasonName=$this->getSeasonDisplayName($em, $seasonId);
        $form = $this->getForm('csv', array('seasonId' => $seasonId, 'request' => $request));

        if($form->isSubmitted()){
            $formData = $form->getData();


            return $this->forward('scheduleIdentityManagerBundle:round:generateRound', array(
                'formData' => $formData
            ));
        }

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:uploadCsvSeason.html.twig', array(
            'form' => $form->createView(),
            'uploadTitle' => $seasonName
        ));
    }


    /**
     * @Route("/calendar", name="renderSeasonCalendar")
     * @Method({"POST"})
     */
    public function renderSeasonCalendarAction(Request $request){



    }

    /**
     * @Route("/new", name="season_new")
     * @Method({"POST", "GET"})
     */
    public function newSeasonAction(Request $request){
        $season = new season();
        $em = $this->getDoctrine()->getManager();
        $leaguesRepository = $em->getRepository('scheduleIdentityManagerBundle:league');


        $form = $this->getForm('newSeason', array(
            'repository'=>$leaguesRepository,
            'season'=> $season,
            'request'=>$request
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $testData = $form->getData();
            $leagueId = $testData->getLeague();
            $seasonLeague = $leaguesRepository->find($testData->getLeague());
            $season->setLeague($seasonLeague);
            $em->persist($season);
            $em->flush();

            return $this->redirectToRoute('season_index', array('league' => $leagueId));
        }

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:seasonNew.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function getLeagueFormOptions($leaguesRepository){
        $seasonType = array('regural'=>'regural', 'play-off'=>'play-off', 'tournament'=>'tournament');
        $leaguesAll = $leaguesRepository->findAll();
        $leagues = array();
        foreach($leaguesAll as $singleLeague ){
            $leagues[$singleLeague->getId()] = $singleLeague->getLeagueName();
        }
        return array('leagues' => $leagues, 'seasonType' => $seasonType);
    }

    private function getForm($type, $options = array()){

        switch($type) {
            case "newSeason":
                $leaguesRepository = $options['repository'];
                $season = $options['season'];
                $formOptions = $this->getLeagueFormOptions($leaguesRepository);
                $form = $this->createForm('scheduleIdentityManagerBundle\Form\seasonType', $season, $formOptions);
                $form->handleRequest($options['request']);
                return $form;
                break;

            case "csv":

                /*$form = $this->createForm('scheduleIdentityManagerBundle\Form\seasonCSVFileType', null, array('data' => $options['seasonId']));
                $form->handleRequest($options['request']);
                return $form;
                */
                 $formBuilder	=	$this->createFormBuilder()
                    ->add('file', FileType::class, array('label' => "plik"))
                    ->add('seasonId', HiddenType::class, array('data' => $options['seasonId']))
                    ->setMethod('POST');
                return $formBuilder->getForm()->handleRequest($options['request']);
                break;

        }
    }




    private function getSeasonDisplayName($em, $seasonId){

        $query = $em->createQuery("Select l.leagueName, s.seasonStartDate, s.seasonEndDate 
                                   from scheduleIdentityManagerBundle:season s 
                                   join scheduleIdentityManagerBundle:league l 
                                   where s.id = :seasonId 
                                   and s.league = l.id ");
        $query->setParameter("seasonId", $seasonId);
        $leagueSeasonData = $query->getResult()[0];

        return  $leagueSeasonData['leagueName'] ." - sezon ".
                $leagueSeasonData['seasonStartDate']->format('Y').'-'.
                $leagueSeasonData['seasonEndDate']->format('Y');
    }





}
