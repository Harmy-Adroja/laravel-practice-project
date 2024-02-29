<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{
    public function apiException($request,$e)
    {
        if($e instanceof ModelNotFoundException){
            return response()->json([
                'errors'=>'Product Model Not Found'
            ],Responce::HTTP_NOT_FOUND);
        }
        
        if($e instanceof NotFoundHttpException){
            return response()->json([
                'errors'=>'incorrect route'
            ],Responce::HTTP_NOT_FOUND);
        }
    }

}