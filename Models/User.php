<?php
require_once __DIR__ . "/ConnectionBdd.php";

class User extends ConnexionBdd
{
    public function __construct()
    {
        parent::__construct($this->bdd);
    }

    // Methode inscription

    public function userSignUp($pseudo, $userMail, $userPass)
    {
        $checkStmt = "SELECT id 
        FROM users
        WHERE mail = :userMail";
        $checkStmt = $this->bdd->prepare($checkStmt);
        $checkStmt->execute([
            ':userMail' => $userMail
        ]);
        if ($checkStmt->fetch()) {
            return [
                'status' => 'error',
                'message' => "Cette adresse mail est déjà utilisée !"
            ];
        }
        // hash du password
        $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);
        $signUpStmt = "INSERT INTO users (pseudo,mail, password, role,status) VALUES (:pseudo, :mail, :password, :role,:status)";
        $signUpStmt = $this->bdd->prepare($signUpStmt);
        $success = $signUpStmt->execute([
            ':pseudo' => $pseudo,
            ':mail' => $userMail,
            ':password' => $hashedPass,
            ':role' => 'user',
            ':status' => 'active'
        ]);
        if ($success) {
            return [
                'status' => 'success',
                'message' => "Inscription réussie !"
            ];
        } else {
            return [
                'status' => 'error',
                'message' => "Erreur lors de l'inscription."
            ];
        }
    }

    // Methode connexion
    public function userLogin($userMail, $userPass): array
    {
        $loginStmt = "SELECT * FROM users WHERE mail = :userMail";
        $loginStmt = $this->bdd->prepare($loginStmt);
        $loginStmt->execute([
            ':userMail' => $userMail
        ]);
        $user = $loginStmt->fetch(PDO::FETCH_ASSOC);

        if ($user && (password_verify($userPass, $user['password']) || $userPass == $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userPseudo'] = $user['pseudo'];
            $_SESSION['userMail'] = $user['mail'];
            $_SESSION['userRole'] = $user['role'];
            $_SESSION['userStatus'] = $user['status'];

            return [
                'status' => 'success',
                'message' => 'Connexion réussie',
                'user' => [
                    'id' => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'mail' => $user['mail'],
                    'role' => $user['role'],
                    'status' => $user['status']
                ]
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Pseudo ou mot de passe incorrect!'
            ];
        }
    }

    // Methode de récupération de toutes les aventure d'un utilisateur
    public function getAllAdventureByUser($userId)
    {
        $result = [];

        // Lone Wolf
        $lwQuery = "SELECT lw_adventure.id , lw_adventure.title
                FROM lw_users 
                JOIN lw_adventure ON lw_users.lw_id = lw_adventure.id 
                WHERE lw_users.user_id = :userId";
        $lwStmt = $this->bdd->prepare($lwQuery);
        $lwStmt->execute([':userId' => $userId]);
        $result['lone_wolf'] = $lwStmt->fetchAll(PDO::FETCH_ASSOC);

        // Quête du Graal
        $qgQuery = "SELECT qg_adventure.id, qg_adventure.title 
                FROM qg_users 
                JOIN qg_adventure ON qg_users.qg_id = qg_adventure.id 
                WHERE qg_users.user_id = :userId";
        $qgStmt = $this->bdd->prepare($qgQuery);
        $qgStmt->execute([':userId' => $userId]);
        $result['quete_graal'] = $qgStmt->fetchAll(PDO::FETCH_ASSOC);

        // Défis Fantastiques
        $dfQuery = "SELECT df_adventure.id, df_adventure.title 
                FROM df_users 
                JOIN df_adventure ON df_users.df_id = df_adventure.id 
                WHERE df_users.user_id = :userId";
        $dfStmt = $this->bdd->prepare($dfQuery);
        $dfStmt->execute([':userId' => $userId]);
        $result['defis_fantastiques'] = $dfStmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
