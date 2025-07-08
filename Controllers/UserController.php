<?php
require_once __DIR__ . '/../Models/User.php';

class UserController
{
    public function login()
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
            $mail = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            $userModel = new User();
            $result = $userModel->userLogin($mail, $password);
            file_put_contents("result_log.txt", print_r($result, true));
            echo json_encode($result);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function signup()
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
            $pseudo = $data['pseudo'] ?? '';
            $mail = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            $userModel = new User();
            $result = $userModel->userSignUp($pseudo, $mail, $password);
            file_put_contents("result_log.txt", print_r($result, true));
            echo json_encode($result);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function getAllAdventureByUser($userId)
    {
        try {
            header('Content-Type: application/json');
            $userModel = new User();
            $result = $userModel->getAllAdventureByUser($userId);
            file_put_contents("result_log.txt", print_r($result, true));
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
