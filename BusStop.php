<?php

require_once('Person.php');

class BusStop {

    private array $queue;

    public function __construct()
    {
        $this->queue = [];
    }

    public function setQueue(array $queue) {
        $this->queue = $queue;
    }

    public function popPerson(): Person {
        return array_pop($this->queue);
    }


    public function addPerson(Person $person) {
        $this->queue[] = $person;
    }

    public function getNumQueuing() {
        return count($this->queue);
    }

}