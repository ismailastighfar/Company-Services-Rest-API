<?php

namespace App\Traits;

trait APIResponseTrait

{
    public function ok($data = [])
    {
        return response()->json(['data' => $data], 200);
    }

    public function created($data = [])
    {
        return response()->json(['data' => $data], 201);
    }

    public function noContent($data = [])
    {
        return response()->json([], 204);
    }

    public function badRequest($message = 'Validation Failure', $errors = [])
    {
        return $this->handleErrorResponse($message, $errors, 400);
    }

    public function unauthorized($message = 'User unauthorized', $errors = [])
    {
        return $this->handleErrorResponse($message, $errors, 401);
    }

    public function forbidden($message = 'Access denied', $errors = [])
    {
        return $this->handleErrorResponse($message, $errors, 403);
    }

    public function notFound($message = 'Resource not found.', $errors = [])
    {
        return $this->handleErrorResponse($message, $errors, 404);
    }

    public function internalServerError($message = 'Internal Server Error.', $errors = [])
    {
        return $this->handleErrorResponse($message, $errors, 500);
    }

    protected function handleErrorResponse($message, $errors, $status)
    {
        $response = ['message' => $message];

        if (count($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

}
