<?php
require_once __DIR__ . '/../Models/LoneWolf.php';
class LoneWolfController
{
    public function getAdventureById($adventureId)
    {
        try {
            header('Content-Type: application/json');
            $userModel = new LoneWolf();
            $result = $userModel->getAdventureById($adventureId);
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function updateAdventure($adventureId)
    {
        try {
            header('Content-Type: application/json');
            $userModel = new LoneWolf();
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'aucune donnée reçus ou JSON invalide'
                ]);
                return;
            }
            $title = $data['title'] ?? '';
            $chapter = $data['chapter'] ?? '';
            $ability = $data['ability'] ?? '';
            $endurance = $data['endurance'] ?? '';
            $weapon1 = $data['weapon1'] ?? '';
            $weapon2 = $data['weapon2'] ?? '';
            $discipline_one = $data['discipline_one'] ?? '';
            $discipline_two = $data['discipline_two'] ?? '';
            $discipline_three = $data['discipline_three'] ?? '';
            $discipline_for = $data['discipline_for'] ?? '';
            $discipline_five = $data['discipline_five'] ?? '';
            $discipline_six = $data['discipline_six'] ?? '';
            $discipline_more_one = $data['discipline_more_one'] ?? '';
            $discipline_more_two = $data['discipline_more_two'] ?? '';
            $discipline_more_three = $data['discipline_more_three'] ?? '';
            $discipline_more_for = $data['discipline_more_for'] ?? '';
            $discipline_more_five = $data['discipline_more_five'] ?? '';
            $discipline_more_six = $data['discipline_more_six'] ?? '';

            $userModel = new LoneWolf();
            $result = $userModel->updateAdventure($adventureId, $title, $chapter, $ability, $endurance, $weapon1, $weapon2, $discipline_one, $discipline_two, $discipline_three, $discipline_for, $discipline_five, $discipline_six, $discipline_more_one, $discipline_more_two, $discipline_more_three, $discipline_more_for, $discipline_more_five, $discipline_more_six);
            file_put_contents("result_log.txt", print_r($result, true));
            echo json_encode($result);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function createAdventure()
    {
        try {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Aucune donnée reçue ou JSON invalide'
                ]);
                return;
            }
            $title = $data['title'] ?? '';
            $chapter = $data['chapter'] ?? '';
            $ability = $data['ability'] ?? '';
            $endurance = $data['endurance'] ?? '';
            $weapon1 = $data['weapon1'] ?? '';
            $weapon2 = $data['weapon2'] ?? '';
            $discipline_one = $data['discipline_one'] ?? '';
            $discipline_two = $data['discipline_two'] ?? '';
            $discipline_three = $data['discipline_three'] ?? '';
            $discipline_for = $data['discipline_for'] ?? '';
            $discipline_five = $data['discipline_five'] ?? '';
            $discipline_six = $data['discipline_six'] ?? '';
            $discipline_more_one = $data['discipline_more_one'] ?? '';
            $discipline_more_two = $data['discipline_more_two'] ?? '';
            $discipline_more_three = $data['discipline_more_three'] ?? '';
            $discipline_more_for = $data['discipline_more_for'] ?? '';
            $discipline_more_five = $data['discipline_more_five'] ?? '';
            $discipline_more_six = $data['discipline_more_six'] ?? '';

            $userModel = new LoneWolf();
            $result = $userModel->createAdventure($title, $chapter, $ability, $endurance, $weapon1, $weapon2, $discipline_one, $discipline_two, $discipline_three, $discipline_for, $discipline_five, $discipline_six, $discipline_more_one, $discipline_more_two, $discipline_more_three, $discipline_more_for, $discipline_more_five, $discipline_more_six);
            file_put_contents("result_log.txt", print_r($result, true));
            echo json_encode($result);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function deleteAdventure()
    {
        try {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['id'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'ID manquant pour la suppression.'
                ]);
                return;
            }

            $id = intval($data['id']);
            $userModel = new LoneWolf();
            $userModel->deleteAdventure($id);

            echo json_encode([
                'status' => 'success',
                'message' => "Aventure supprimée avec succès (ID : $id)"
            ]);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
