<?php

class MedalController extends Controller
{
    public function index() {
        $this->json_response(Medal::getInstance()->index());
    }

    public function get($medalId) {
        if (!Medal::getInstance()->medalExists($medalId)) {
            $this->json_error("Medal doesn't exist");
        }
        $this->json_response(Medal::getInstance()->get($medalId));
    }

    public function grant($medalId, $username) {
        if (!Medal::getInstance()->medalExists($medalId)) {
            $this->json_error("Medal doesn't exist");
        }
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User doesn't exist");
        }

        Medal::getInstance()->grantMedal($username, $medalId);
    }

    public function listMedals($username) {
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User doesn't exist");
        }

        Medal::getInstance()->listMedals($username);
    }
}