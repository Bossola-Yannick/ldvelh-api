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
    public function createAdventureByUser() {}
    public function updateAdventureByUser() {}
    public function deleteAdventureByUser() {}
}
