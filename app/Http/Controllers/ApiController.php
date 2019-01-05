<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    const HTTP_Not_Found = 404;
    const HTTP_Success_Created = 201;
    const HTTP_Parameter_ERROR = 422;
    const HTTP_Doesnt_Exists = 400;
    /**
     * @var int
     */
    protected $statusCode=200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return ApiController
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondeNotFound($message='Not Found')
    {
        return $this->setStatusCode(self::HTTP_Not_Found)->respondeWithError($message);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondeWithError($message)
    {
        return $this->respond(['errors'=>
                [
                    'message'=>$message,
                    'Status Code'=>$this->getStatusCode(),
                ]
            ]
        );
    }

    /**
     * @param $data
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $header=[])
    {
        return response()->json($data,$this->getStatusCode(),$header);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($message): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(self::HTTP_Success_Created)->respond($message);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithFailedParameter($message): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(self::HTTP_Parameter_ERROR)->respondeWithError($message);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithDoesntExists($message): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(self::HTTP_Doesnt_Exists)->respondeWithError($message);
    }
}
