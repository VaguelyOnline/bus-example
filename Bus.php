<?php

require_once('Person.php');

class Bus {

    private int $capacity;
    private array $passengers;

    public function __construct(int $capacity = 50) {
        $this->capacity = $capacity;
        $this->passengers = [];
    }

    public function hasCapacity() {
        return count($this->passengers) < $this->capacity;
    }

    public function setPassengers(array $passengers) {
        $this->passengers = $passengers;
    }

    /**
     * @return bool true if the Person was added (because we had capacity). Otherwise, false.
     */
    public function addPassenger(Person $person): bool {

        if ($person != null && $add = $this->hasCapacity()) $this->passengers[] = $person;
        return $add;
    }

    public function __toString()
    {
        $str = 'On the bus are: ';
        foreach($this->passengers as $passenger) 
            $str .= $passenger->name . "<br>";

        return $str;
    }

    public function getNumOfAvailableSeats() {
        return $this->capacity - count($this->passengers);
    }

    public function process(BusStop $stop) {
        $keepGoing = true;
        while($keepGoing) {
            $person = $stop->popPerson();
            $added = $this->addPassenger($person);

            // If the person waiting could not board the bus, add them back to the queue.
            if (!$added)
                $stop->addPerson($person);

            $keepGoing = $added && $stop->getNumQueuing() > 0;
        }
    }

}