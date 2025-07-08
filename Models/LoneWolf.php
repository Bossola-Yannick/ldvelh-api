<?php
require_once __DIR__ . "/ConnectionBdd.php";

class LoneWolf extends ConnexionBdd
{
    public function __construct()
    {
        parent::__construct($this->bdd);
    }
    public function getAdventureByID() {}
    public function createAdventureByUser() {}
    public function updateAdventureByUser() {}
    public function deleteAdventureByUser() {}
}
