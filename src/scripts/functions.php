<?php 
    $URI = $_SERVER['REQUEST_URI'];
    $str = substr($URI, strripos($URI, '/')+1);
    function group($peopleArr) {
        if(empty($peopleArr)) {
            return '-';
        }
        $groupedPeople = "";
        foreach($peopleArr as $people) {
            foreach($people as $person) {
                $groupedPeople.= "$person, ";
            }
        }
        return substr($groupedPeople, 0, strripos($groupedPeople, ','));
    }
    function replace($str) {
        $rg = '/_|-/i';
        if (preg_match($rg, $str)) {
            $string = preg_replace($rg, ' ', $str);
        } else {
            return $str;
        }
        return $string;
    }
