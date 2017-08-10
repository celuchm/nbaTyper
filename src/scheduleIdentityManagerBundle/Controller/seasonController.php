<?php

namespace scheduleIdentityManagerBundle\Controller;

use scheduleIdentityManagerBundle\Entity\discipline;
use scheduleIdentityManagerBundle\Entity\season;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;


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
     * @Route("/teams", name="seasonTeams")
     */
    public function showSeasonTeamsAction(Request $request){

    }

    /**
     * @Route("/uploadCallendarCsvForm/{seasonId}", name="uploadCsvCalendarForm")
     */
    public function uploadCsvCalendarAction(Request $request, $seasonId){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("Select l.leagueName, s.seasonStartDate, s.seasonEndDate from scheduleIdentityManagerBundle:season s join scheduleIdentityManagerBundle:league l where s.id = :seasonId and s.league = l.id ");
        $query->setParameter("seasonId", $seasonId);
        $leagueSeasonData = $query->getResult()[0];
        $seasonName = $leagueSeasonData['leagueName'] ." - sezon " . $leagueSeasonData['seasonStartDate']->format('Y'). '-' . $leagueSeasonData['seasonEndDate']->format('Y');

        $formBuilder	=	$this->createFormBuilder()
            ->add('file', FileType::class, array('label' => "plik"))
            ->setAction($this->generateUrl('renderSeasonCalendar'))
            ->setMethod('POST');

        $form = $formBuilder->getForm();

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:uploadCsvSeason.html.twig', array(
            'form' => $form->createView(),
            'uploadTitle' => $seasonName
        ));
    }


    /**
     * @Route("/calendar", name="renderSeasonCalendar")
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
        $formOptions = $this->getLeagueFormOptions($leaguesRepository);

        $form = $this->createForm('scheduleIdentityManagerBundle\Form\seasonType', $season, $formOptions);
        $form->handleRequest($request);

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








}
