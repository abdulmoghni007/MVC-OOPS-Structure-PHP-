<?php

function response(array $data, int $status = 200)
{
    http_response_code($status);
    echo json_encode($data);
    exit();
}
