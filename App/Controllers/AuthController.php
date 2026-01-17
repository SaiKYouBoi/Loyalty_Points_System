<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Session;
use App\Models\User;
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


    public function submitRegister(): void
    {
        $err = false;

        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm_password'] ?? '');

        $this->validateRegister($err, $name, $email, $password, $confirm);

        if (!$err) {
            if (User::create($name, $email, $password)) {
                Session::flash('success', 'Registration successful.');
                header('Location: /login');
                exit();
            }

            Session::flash('error', 'Registration failed.');
        }

        header('Location: /register');
        exit();
    }

    private function validateRegister(
        bool &$err,
        string $name,
        string $email,
        string $password,
        string $confirm
    ): void {
        Session::flash('name', htmlspecialchars($name));
        Session::flash('email', htmlspecialchars($email));

        if ($name === '') {
            Session::flash('name-err', 'Name is required.');
            $err = true;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('email-err', 'Invalid email.');
            $err = true;
        } elseif (User::emailExists($email)) {
            Session::flash('email-err', 'Email already exists.');
            $err = true;
        }

        if ($password === '') {
            Session::flash('password-err', 'Password is required.');
            $err = true;
        }

        if ($password !== $confirm) {
            Session::flash('confirm_password-err', 'Passwords do not match.');
            $err = true;
        }
    }

    public function submitLogin(): void
    {
        $err = false;

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $this->validateLogin($err, $email, $password);

        if (!$err) {
            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user->getPasswordHash())) {
                Session::set('user_id', $user->getId());
                Session::flash('success', 'Connected successfully.');
                header('Location: /');
                exit();
            }

            Session::flash('error', 'Email or password incorrect.');
        }

        header('Location: /login');
        exit();
    }

    private function validateLogin(bool &$err, string $email, string $password): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('email-err', 'Invalid email.');
            $err = true;
        }

        if ($password === '') {
            Session::flash('password-err', 'Password is required.');
            $err = true;
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}