<?php


namespace App\Utils;


use App\Entity\Trajet;
use App\Entity\User;

class Reservation
{
    public function distance($lat1,$lat2,$long1,$long2){
        $x=deg2rad($long1-$long2)*cos(deg2rad(($lat1+$lat2)/2));
        $y=deg2rad($lat1-$lat2);
        $dist = 6371000.0 * sqrt($x*$x+$y*$y);
        return $dist;
    }

    public function distanceDepart(User $user,Trajet $trajet){
        list($latuser,$longuser) = $user->current_coordinates();
        $depart = $trajet->getLieudepart();
        $distance = $this->distance($latuser,$longuser,$depart->getLatitude(),$depart->getLongitude());
        return $distance;
    }

    public function passagerReservation(User $user,Trajet $trajet){
        $user->addPassagerTrajet($trajet);
    }
}