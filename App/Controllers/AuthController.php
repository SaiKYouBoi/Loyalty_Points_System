<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Session;
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

    public function submitregister()
    {
        $err = false;
        $name = trim($_POST["name"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');
        $confirm_password = trim($_POST["password"] ?? '');

        $this->validationRegister($err, $name, $email, $password, $confirm_password);

        if (!$err) {
            $query = "INSERT INTO users (name,email,password_hash) VALUES (:name,:email,:password_hash)";
            $stmt = Database::getInstance()->prepare($query);
            if (
                $stmt->execute([
                    "name" => $name,
                    "email" => $email,
                    "password_hash" => password_hash($password, PASSWORD_BCRYPT)
                ])
            ) {
                Session::flash('success', 'Registration successful.');
                header("Location: /login");
                exit();
            }

            Session::flash('error', 'Registration failed. Please try again.');
        }

        header("Location: /register");
        exit();

    }

    public function validationRegister(&$err, $name, $email, $password, $confirm_password)
    {
        Session::flash('name', htmlspecialchars($name, ENT_QUOTES));
        Session::flash('email', htmlspecialchars($email, ENT_QUOTES));
        Session::flash('password', htmlspecialchars($password, ENT_QUOTES));
        Session::flash('confirm_password', htmlspecialchars($confirm_password, ENT_QUOTES));

        if ($name === "") {
            Session::flash('name-err', 'Name is required.');
            $err = true;
        }

        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('email-err', 'Email invalid.');
            $err = true;
        } else {
            $query = "SELECT email FROM users WHERE email = ?";
            $stmt = Database::getInstance()->prepare($query);
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                Session::flash('email-err', 'Email already exists.');
                $err = true;
            }
        }

        if ($password === "") {
            Session::flash('password-err', 'Password is required.');
            $err = true;
        }

        if ($confirm_password === "") {
            Session::flash('confirm_password-err', 'Password confirmation is required.');
            $err = true;
        }

        if ($password !== $confirm_password) {
            Session::flash('confirm_password-err', 'The passwords do not match.');
            $err = true;
        }

    }

    public function submitLogin()
    {
        $err = false;
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');

        $this->validationLogin($err, $email, $password);
        if (!$err) {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = DataBase::getInstance()->prepare($query);
            if ($stmt->execute([$email])) {
                if ($stmt->rowCount() === 1) {
                    $user = $stmt->fetch();
                    if (password_verify($password, $user['password_hash'])) {
                        unset($_SESSION['email'], $_SESSION['password']);
                        Session::set('user_id', $user['id']);
                        Session::flash('success', "Connected succesfully.");
                        header("Location: /");
                        exit();
                    } else {
                        Session::flash('error', "Email ou mot de passe incorrect.");
                    }
                } else {
                    Session::flash('error', "Email ou mot de passe incorrect.");
                }
            } else {
                Session::flash('error', "Une erreur est survenue. Veuillez réessayer plus tard.");
            }
        }

        header("Location: /login");
        exit();
    }

    public function validationLogin(&$err, $email, $password)
    {

        Session::flash("email", "htmlspecialchars($email, ENT_QUOTES)");
        Session::flash("password", "htmlspecialchars($password, ENT_QUOTES)");

        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash("email-err", "Email invalide.");
            $err = true;
        }

        if ($password === "") {
            Session::flash("password-err", "Le mot de passe est obligatoire.");
            $err = true;
        }
    }

     public function logout(){
        session_destroy();
        header("Location: /login");
        exit();
    }
    
}