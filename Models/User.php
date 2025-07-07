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
        FROM user
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
    public function userConnexion($userMail, $userPass): array
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
}
