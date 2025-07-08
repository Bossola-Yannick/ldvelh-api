<?php
require_once __DIR__ . "/ConnectionBdd.php";

class LoneWolf extends ConnexionBdd
{
    public function __construct()
    {
        parent::__construct($this->bdd);
    }
    public function getAdventureByID($adventureId)
    {
        // recup aventure
        $adventureQuery = "SELECT lw_adventure.id AS adventure_id, lw_adventure.title, lw_adventure.chapter,lw_adventure.ability,lw_adventure.endurance,lw_adventure.weapon1,lw_adventure.weapon2,lw_adventure.discipline_one,lw_adventure.discipline_two,lw_adventure.discipline_three,lw_adventure.discipline_for,lw_adventure.discipline_five,lw_adventure.discipline_six,lw_adventure.discipline_more_one,lw_adventure.discipline_more_two,lw_adventure.discipline_more_three,lw_adventure.discipline_more_for,lw_adventure.discipline_more_five,lw_adventure.discipline_more_six 
                FROM lw_adventure
                WHERE lw_adventure.id = :adventureId";
        $adventureStmt = $this->bdd->prepare($adventureQuery);
        $adventureStmt->execute([':adventureId' => $adventureId]);
        $adventure = $adventureStmt->fetchAll(PDO::FETCH_ASSOC);
        //  recup élément du sac
        $bagQuery = "SELECT lw_bag.id AS bag_id, lw_bag.object, lw_bag.status
        FROM lw_bag
        WHERE lw_id = :adventureId";
        $bagStmt = $this->bdd->prepare(($bagQuery));
        $bagStmt->execute([':adventureId' => $adventureId]);
        $bag = $bagStmt->fetchAll(PDO::FETCH_ASSOC);
        // recup les notes
        $noteQuery = "SELECT lw_notes.id AS notes_Id, lw_notes.note
        FROM lw_notes
        WHERE lw_id = :adventureId";
        $noteStmt = $this->bdd->prepare(($noteQuery));
        $noteStmt->execute([':adventureId' => $adventureId]);
        $note = $noteStmt->fetchAll(PDO::FETCH_ASSOC);
        // mise en un seul tableau
        $adventure['bag'] = $bag;
        $adventure['note'] = $note;
        return ['lone_wolf' => $adventure];
    }
    public function createAdventureByUser() {}
    public function updateAdventureByUser() {}
    public function deleteAdventureByUser() {}
}
