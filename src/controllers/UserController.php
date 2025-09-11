<?php

require_once "core/Controller.php";
require_once "models/User.php";

class UserController extends Controller
{
    public function index() {
        $this->json_response(User::getInstance()->all());
    }

    public function show($username) {
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User doesn't exist");
        }
        $this->json_response(User::getInstance()->get($username));
    }

    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User doesn't exist");
        }

        if (User::getInstance()->verify($username, $password)) {
            $this->json_response([
                "authenticated" => true
            ]);
        } else {
            $this->json_error("Wrong password");
        }
    }

    public function getFriends($username) {
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User doesn't exist");
        }
        $this->json_response(User::getInstance()->getFriends($username));
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if ($username === "helloKitty" || $username === "dora") {
            $this->json_error("Protected username");
        }

        if (!User::getInstance()->userExists($username)) {
            User::getInstance()->createUser($username, $password);
        } else {
            $this->json_error("User already exists");
        }
    }

    public function addFriend($username, $friendUsername) {
        if (!User::getInstance()->userExists($username) || !User::getInstance()->userExists($friendUsername)) {
            $this->json_error("User doesn't exist");
        }
        User::getInstance()->addFriend($username, $friendUsername);
    }

    public function rateUser($username, $rating, $description, $friendUsername) {
        if (!User::getInstance()->userExists($username) || !User::getInstance()->userExists($friendUsername)) {
            $this->json_error("User doesn't exist");
        }
        User::getInstance()->rateUser($username, $rating, $description,$friendUsername);
    }
}