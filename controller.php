<?php

require_once('Person.php');
require_once('BusStop.php');
require_once('Bus.php');

$numPassengers = 25;
$numQueuing = 100;

// Model
$stop = new BusStop();
$stop->setQueue(buildPeople($numQueuing));

// Model
$bus = new Bus();
$bus->setPassengers(buildPeople($numPassengers));

// Controller processing
$bus->process($stop);

$numWaiting = $stop->getNumQueuing();
$numSeatsLeft = $bus->getNumOfAvailableSeats();

// View
include('bus-stop-info.php');


/**
 * Creates an array of Person objects. Useful to quickly populate
 * the queue of people waiting, or the passengers on the bus.
 */
function buildPeople($num): array {
    $people = [];

    for ($i = 0; $i < $num; $i++)
        $people[] = new Person("Person " . rand(0, 9999999));
    
    return $people;
}
