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
        $adventure = $adventureStmt->fetch(PDO::FETCH_ASSOC);
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
    public function createAdventure($title, $chapter, $ability, $endurance, $weapon1, $weapon2, $discipline_one, $discipline_two, $discipline_three, $discipline_for, $discipline_five, $discipline_six, $discipline_more_one, $discipline_more_two, $discipline_more_three, $discipline_more_for, $discipline_more_five, $discipline_more_six)
    {
        $signUpStmt = "INSERT INTO lw_adventure (title,chapter, ability,endurance,weapon1,weapon2,discipline_one, discipline_two,discipline_three,discipline_for,discipline_five,discipline_six,discipline_more_one,discipline_more_two,discipline_more_three,discipline_more_for,discipline_more_five,discipline_more_six) VALUES (:title, :chapter, :ability, :endurance, :weapon1, :weapon2, :discipline_one, :discipline_two, :discipline_three, :discipline_for, :discipline_five, :discipline_six, :discipline_more_one, :discipline_more_two, :discipline_more_three, :discipline_more_for, :discipline_more_five, :discipline_more_six)";
        $signUpStmt = $this->bdd->prepare($signUpStmt);
        $signUpStmt->execute([
            ':title' => $title,
            ':chapter' => $chapter,
            ':ability' => $ability,
            ':endurance' => $endurance,
            ':weapon1' => $weapon1,
            ':weapon2' => $weapon2,
            ':discipline_one' => $discipline_one,
            ':discipline_two' => $discipline_two,
            ':discipline_three' => $discipline_three,
            ':discipline_for' => $discipline_for,
            ':discipline_five' => $discipline_five,
            ':discipline_six' => $discipline_six,
            ':discipline_more_one' => $discipline_more_one,
            ':discipline_more_two' => $discipline_more_two,
            ':discipline_more_three' => $discipline_more_three,
            ':discipline_more_for' => $discipline_more_for,
            ':discipline_more_five' => $discipline_more_five,
            ':discipline_more_six' => $discipline_more_six
        ]);
    }

    public function updateAdventure($id, $title, $chapter, $ability, $endurance, $weapon1, $weapon2, $discipline_one, $discipline_two, $discipline_three, $discipline_four, $discipline_five, $discipline_six, $discipline_more_one, $discipline_more_two, $discipline_more_three, $discipline_more_four, $discipline_more_five, $discipline_more_six)
    {
        $adventureUpdate = "UPDATE users SET 
        title = :title,
        chapter = :chapter,
        ability = :ability,
        endurance = :endurance,
        weapon1 = :weapon1,
        weapon2 = :weapon2,
        discipline_one = :discipline_one,
        discipline_two = :discipline_two,
        discipline_three = :discipline_three,
        discipline_four = :discipline_four,
        discipline_five = :discipline_five,
        discipline_six = :discipline_six,
        discipline_more_one = :discipline_more_one,
        discipline_more_two = :discipline_more_two,
        discipline_more_three = :discipline_more_three,
        discipline_more_four = :discipline_more_four,
        discipline_more_five = :discipline_more_five,
        discipline_more_six = :discipline_more_six
        WHERE id = :id";

        $updateStmt = $this->bdd->prepare($adventureUpdate);

        $updateStmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':chapter' => $chapter,
            ':ability' => $ability,
            ':endurance' => $endurance,
            ':weapon1' => $weapon1,
            ':weapon2' => $weapon2,
            ':discipline_one' => $discipline_one,
            ':discipline_two' => $discipline_two,
            ':discipline_three' => $discipline_three,
            ':discipline_four' => $discipline_four,
            ':discipline_five' => $discipline_five,
            ':discipline_six' => $discipline_six,
            ':discipline_more_one' => $discipline_more_one,
            ':discipline_more_two' => $discipline_more_two,
            ':discipline_more_three' => $discipline_more_three,
            ':discipline_more_four' => $discipline_more_four,
            ':discipline_more_five' => $discipline_more_five,
            ':discipline_more_six' => $discipline_more_six
        ]);

        return [
            'status' => 'success',
            'message' => "Aventure mise à jour avec succès (ID : $id)"
        ];
    }
    public function deleteAdventure($id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM lw_adventure WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
