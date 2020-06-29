<?php


namespace App\Librarys;


trait API
{
    private $statusCode = 200;

    /**
     * @deprecated 已废弃
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function success(array $data = [], int $errno = 0, string $message = '')
    {
        return $this->handle($data, $errno, $message);
    }

    public function error(array $data = [], int $errno = 1, string $message = '')
    {
        return $this->handle($data, $errno, $message);
    }

    private function handle(array $data, int $errno, string $message)
    {
        return response()->json([
            'data' => $data,
            'errno' => $errno,
            'message' => $message
        ])->setStatusCode($this->statusCode);
    }
}
