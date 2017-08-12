<?php

namespace scheduleIdentityManagerBundle\Controller;

use scheduleIdentityManagerBundle\Entity\discipline;
use scheduleIdentityManagerBundle\Entity\team;
use scheduleIdentityManagerBundle\Entity\season;
use scheduleIdentityManagerBundle\Entity\round;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\DateTime;

class roundController extends Controller{

//////   lecimy po pliku CSV - tworzymy tablicę z [data kolejki/dnia] => [[mecz1][mecz2][mecz3]]



    public function generateRoundAction($formData){
        $file = $formData['file'];
        $seasonId = $formData['seasonId'];
        $allGames = $this->getGamesArray($file);
        $gameDays = array_values(array_unique($this->getGameDays($allGames)));
        $allGamesWithDate = $this->alterGameArray($allGames);

        $test = $this->createRounds($gameDays,$seasonId );
        $test2 = $this->createRoundGames($allGamesWithDate,$seasonId );
        //$test2 = $this->createRoundGames($allGamesWithDate);

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:test.html.twig', array(
            'test' => $test2
        ));
    }


    private function getGamesArray($file){
        $fileToOpen = fopen($file,"r");

        $gamesArray = [];
        $i=0;

        while(! feof($fileToOpen))
        {
            $singleRow = fgetcsv($fileToOpen);
            if($i>0){
                $gamesArray[] = $singleRow;
            }
            $i++;
        }
        //$uniqueGameDays = $this->filterArray($gamesArray);
        return  $gamesArray;
    }

    private function getGameDays($games){
        $gameDays = array();
        foreach($games as $game){
            if(isset($game[3])){
                $gameDays[] = date('Y-m-d',strtotime($this->decodeDate($game[3], $this->decodeTime($game[2]))));
            }
        }

        return $gameDays;
    }


    private function alterGameArray($games){
        $alterGames = array();
        foreach($games as $game){
            if(isset($game[3])){
                $game[3] = date('Y-m-d',strtotime($this->decodeDate($game[3], $this->decodeTime($game[2]))));
                $alterGames[] = $game;
            }
        }
        return $alterGames;

    }



    private function decodeDate($csvDate, $hour){
        $year = "";
        $monthDayArray = explode(",", $csvDate);

        $monthDay = explode(" ", $monthDayArray[1]);

        if($monthDay[1] === 'October' || $monthDay[1] === 'November' || $monthDay[1] === 'December'  ){
            $year = "2016";
        } else {
            $year = "2017";
        }

        $hour = $hour + 12;
        if(strlen($hour)==1){
            $hour = "0".$hour;
        }
        $date = $monthDay[2]."-".$monthDay[1]."-".$year." ".$hour.":00:00";
        return $date;
    }

    private function decodeTime($csvTime){
        $hour = explode(":", $csvTime);
        $hour = $hour[0];
        return $hour;
    }

    private function filterArray($array){
        $filterArray = array();
        $i = 0;
        foreach($array as $row){
            if($i==0){
                $filterArray[] = $row;
            } else {
                if(!in_array($row, $filterArray)){
                    $filterArray[] = gettype($row);
                }
            }
            $i++;
        }
        return $filterArray;
    }


    private function createRounds($gameDays, $seasonId) {
        $test = array();
        foreach ($gameDays as $singleDay){
            $round = new round();
            $roundStartDay = new \DateTime();
            $roundStartDay->setTimestamp(strtotime($singleDay));

            $round->setRoundType('day');
            $round->setDateStart($roundStartDay);
            $round->setSeasonId($seasonId);

            //$em	=	$this->getDoctrine()->getManager();
            //$em->persist($round);
            //$em->flush();
            $test[] = array(gettype($round->getDateStart()), date('Y-m-d',strtotime($singleDay)), $seasonId);
        }
        return $test;
    }

    private function createRoundGames($games, $seasonId){
        $em	=	$this->getDoctrine()->getManager();
        $teamRepo = $em->getRepository('scheduleIdentityManagerBundle:team');
        $result = array();
        foreach($games as $game){
            if(isset($game[3])){
                //$teamHome = $em->findBy('team', $game[0]);
                $teamHome = $teamRepo->findOneBy(array("teamShortName" => $game[0]));
                $teamAway = $teamRepo->findOneBy(array("teamShortName" => $game[1]));
                //$teamAway = $em->find('team', $game[1]);
                $result[] = array($teamHome->getId(), $teamAway->getId(), $game[2].' '.$game[3]);
            }
        }
        return $result;
    }





}
