<?php
namespace App\Controllers;

use App\Core\Controller;
use Database\Database;

class AuthController extends Controller
{
    public function login(): void
    {
        $this->view('login.view.twig');
    }

    public function register(): void
    {
        $this->view('register.view.twig');
    }

    public function submitregister(){
        $err = false;
        $name = trim($_POST["name"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');
        $confirm_password = trim($_POST["password"] ?? '');

        $this->validationRegister($err,$name,$email,$password,$confirm_password);

        if (!$err) {
            $query = "INSERT INTO users (name,email,password_hash) VALUES (:name,:email,:password_hash)";
            $stmt = Database::getInstance()->prepare($query);
            if ($stmt->execute([
                "name" => $name,
                "email" => $email,
                "password_hash" => password_hash($password,PASSWORD_BCRYPT)
                ])) {
                $_SESSION['success'] = "Registration successful.";
                header("Location: /login");
                exit();
            }
            
            $_SESSION['error'] = "Registration failed. Please try again.";
        }

        header("Location: /register");
        exit();

    }   

    public function validationRegister($err,$name,$email,$password,$confirm_password){
        $_SESSION['name'] = htmlspecialchars($name, ENT_QUOTES);
        $_SESSION['email'] = htmlspecialchars($email, ENT_QUOTES);
        $_SESSION['password'] = htmlspecialchars($password, ENT_QUOTES);
        $_SESSION['confirm_password'] = htmlspecialchars($confirm_password, ENT_QUOTES);
        
         if ($name === "") {
            $_SESSION['firstName-err'] = "Name is required.";
            $err = true;
        }


        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email-err'] = "Email invalid.";
            $err = true;
        }else{
            $query = "SELECT email FROM users WHERE email = ?";
            $stmt = Database::getInstance()->prepare($query);
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['email-err'] = "Email already exists.";
                $err = true;
            }
        }

        if ($password === "") {
            $_SESSION['password-err'] = "Password is required.";
            $err = true;
        }

        if ($confirm_password === "") {
            $_SESSION['confirm_password-err'] = "Password confirmation is required.";
            $err = true;
        }

        if ($password !== $confirm_password) {
            $_SESSION['confirm_password-err'] = "The passwords do not match.";
            $err = true;
        }

    }

}