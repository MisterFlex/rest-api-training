<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 07/12/2017
 * Time: 13:46
 */

namespace AppBundle\Normalizer;


use Symfony\Component\HttpFoundation\Response;

class NotFoundHttpExceptionNormalizer extends AbstractNormalizer
{
    public function normalize(\Exception $exception)
    {
        $result['code'] = Response::HTTP_NOT_FOUND;
        $result['body'] = [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => $exception->getMessage()
        ];

        return $result;
    }
}