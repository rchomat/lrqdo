<?php

namespace App\Listener;

use App\Exception\LrqdoExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();
        $message = [
            'error_code' => $exception->getCode(),
            'error_message' => $exception->getMessage(),
        ];

        if ($exception instanceof LrqdoExceptionInterface) {
            $message = [
                'error_code' => $exception->getCode(),
                'error_key' => $exception->getErrorKey(),
                'error_message' => $exception->getMessage(),
            ];

            $response->setStatusCode($exception->getCode());
        } elseif ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->setContent(json_encode($message));

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}
