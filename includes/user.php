<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/db.php';

class User {
    private DB $db;
    private array $user;
    private bool $isLogged;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = new DB();
        $this->isLogged = false;
        $this->user = [];
    }

    /**
     * @throws Exception
     */
    /**
     * @throws Exception
     */
    public function login($username, $password): bool
    {
        try {
            $result = $this->db->query("SELECT * FROM users WHERE username = '$username'");

            if ($result === false) {
                throw new Exception("Error base de données");
            }

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $this->user = $user;
                    $this->isLogged = true;
                    $_SESSION['user'] = $user;
                    return true;
                } else {
                    throw new Exception("Mot de passe incorrect");
                }
            } else {
                throw new Exception("Nom d'utilisateur incorrect");
            }
        } catch (Exception $e) {
            throw new Exception("Connexion impossible : " . $e->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function register($username, $password, $password_confirm, $email): bool
    {
        try {
            $result = $this->db->query("SELECT * FROM users WHERE username = '$username'");

            if ($result === false) {
                throw new Exception("Erreur base de données");
            }

            if ($result->num_rows === 0) {
                if ($password === $password_confirm) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $insertResult = $this->db->query("INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')");

                    if ($insertResult === false) {
                        throw new Exception("Erreur lors de l'inscription");
                    }

                    return true;
                } else {
                    throw new Exception("Les mots de passe ne correspondent pas");
                }
            } else {
                throw new Exception("Nom d'utilisateur déjà pris");
            }
        } catch (Exception $e) {
            throw new Exception("Inscription impossible : " . $e->getMessage());
        }
    }


    public function isLogged(): bool
    {
        return $this->isLogged;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function verifyCredentials(): void
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            $result = $this->db->query("SELECT * FROM users WHERE (username, uuid) = ('{$user['username']}', '{$user['uuid']}')");

            if ($result->num_rows === 1) {
                $this->user = $user;
                $this->isLogged = true;
            } else {
                $this->logout();
            }
        }
    }
    public function logout(): void
    {
        $this->isLogged = false;
        $this->user = [];
        session_destroy();
    }
}