<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    protected $status_code = 500;
    protected $error_array = [];

    public function __construct($resource, $errorArray = [])
    {

        parent::__construct($resource);
        $this->error_array = $errorArray;

    }

    /**
     *  * Transform the resource into an array.
     *  *
     *  * @param  \Illuminate\Http\Request  $request
     *  * @return array
     *  */
    public function toArray($request)
    {
        return [
            'type' => $this->formattedTypeName(strtolower(get_class(($this->resource)))),
            'message' => $this->getMessage(),
            'status' => 'error',
            'status_code' => $this->statusCodeFromMessage(strtolower($this->getMessage())),
            'errors' => $this->error_array // todo - how would we get these?
        ];
    }

    public function withResponse($request, $response)
    {

        $response->setStatusCode($this->status_code);

    }

    private function formattedTypeName($className)
    {
        $typeName = $className;

        switch ($typeName) {

            default:
                $typeName = 'generic';

        }

        return $typeName;

    }

    private function statusCodeFromMessage($message)
    {

        switch (strtolower($message)) {

            case 'unauthorized':
            case 'signature verification failed':
                $this->status_code = 403;
                break;

            case 'not found':
                $this->status_code = 404;
                break;

            case 'invalid grade code':
                $this->status_code = 422;
                break;

            default:
                $this->status_code = 500;

        }

        return $this->status_code;

    }

}
