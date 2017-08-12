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

class roundController extends Controller{





    public function generateRoundAction($formData){
        $file = $formData['file'];
        $allGames = $this->getGamesArray($file);
        $gameDays = array_values(array_unique($this->getGameDays($allGames)));

        foreach ($gameDays as $singleDay){
            $round = new round();
            $round->setRoundType('day');
            $round->setDateStart($singleDay);
            $round->setSeasonId($formData['seasonId']);


        }


        return $this->render('scheduleIdentityManagerBundle:scheduleManager:test.html.twig', array(
            'test' => $formData
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






}
