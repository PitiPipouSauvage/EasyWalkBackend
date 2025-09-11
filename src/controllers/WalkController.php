<?php

class WalkController extends Controller
{
    public function add(string $username, $steps, $walkDate, $points, $distance) {
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User does not exist");
        }

        if ($steps < 0 || $points < 0 || $distance < 0) {
            $this->json_error("Invalid data");
        }

        Walk::getInstance()->addWalk($username, $steps, $walkDate, $points, $distance);
    }

    public function getWalks(string $username, $ammount) {
        if (!User::getInstance()->userExists($username)) {
            $this->json_error("User does not exist");
        }

        if ($ammount < 0) {
            $this->json_error("Invalid data");
        }

        if ($ammount === 0) {
            $this->json_response([]);
        }

        $this->json_response(Walk::getInstance()->getWalks($username, $ammount));
    }
}