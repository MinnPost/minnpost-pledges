<?php

include('config.php');

function get_timeago( $ptime ) {
    $estimate_time = time() - $ptime;

    if ( $estimate_time < 1 ) {
        return 'less than 1 second ago';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach ( $condition as $secs => $str ) {
        $d = $estimate_time / $secs;

        if ( $d >= 1 ) {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}


if ($details == true) {
$sql = <<<SQL
    SELECT *
    FROM `{$table}`
SQL;

    if(!$result = $db->query($sql)) {
        die('There was an error running the query [' . $db->error . ']');
    } else {
    	include('pledges.php');
    }

} else {
$sql = <<<SQL
    SELECT amount
    FROM `{$table}`
SQL;

    if (!$result = $db->query($sql)) {
        die('There was an error running the query [' . $db->error . ']');
    } else {
        $total = '';
        while($row = $result->fetch_assoc()){
            $total = $total + $row['amount'];
        }
        include('summary.php');
    }

}

?>