<?php

namespace core;

class Controller
{
    protected function json_response(array $data, int $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function json_error(string $message, int $status = 400) {
        $this->json_response(['error' => $message], $status);
    }
}