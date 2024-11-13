<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HandleResponse
{
    public int $pagination = 10;

    public function response($data, $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $status);
    }

    public function successWithData($data, $msg, $dataExtra = null, $status_code = Response::HTTP_OK): JsonResponse
    {
        return $this->response([
            'success' => true,
            'massage' => $msg,
            'status_code' => $status_code,
            'data' => $data,
            'extra_data' => $dataExtra,
        ], 200);
    }

    public function successMessage($msg = '', $errNum = '200')
    {
        return [
            'success' => true,
            'errNum' => $errNum,
            'msg' => $msg,
        ];
    }

    public function fail($code = 'internal_error', $msg = 'Internal Server Error', $errors = [], $status_code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->response([
            'success' => false,
            'status_code' => $status_code,
            'error_code' => $code,
            'message' => $msg,
            'error' => $errors,
        ], $status_code);
    }

    public function createdResponse($data, $msg, $status_code = Response::HTTP_CREATED): JsonResponse
    {
        return $this->response([
            'status' => true,
            'massage' => $msg,
            'status_code' => $status_code,
            'data' => $data,
        ], 201);
    }

    public function badRequestResponse($msg): JsonResponse
    {
        return $this->fail('bad request', $msg, 'BAD REQUEST', Response::HTTP_BAD_REQUEST);
    }
}
