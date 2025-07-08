<?php
require_once __DIR__ . "/ConnectionBdd.php";

class FightingFantasy extends ConnexionBdd
{
    public function __construct()
    {
        parent::__construct($this->bdd);
    }
    public function getAdventureByID() {}
    public function createAdventure() {}
    public function updateAdventure() {}
    public function deleteAdventure() {}
}
