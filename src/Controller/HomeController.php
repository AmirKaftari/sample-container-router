<?php

declare(strict_types= 1);

namespace App\Controller;

use App\Repository;

 class HomeController {
    public function __construct(private Repository $repository) {

    }
    public function index() {
        http_response_code(200);
        echo json_encode($this->repository->all());
    }
 }