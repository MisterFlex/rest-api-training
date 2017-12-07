<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 07/12/2017
 * Time: 12:26
 */

namespace AppBundle\Normalizer;


abstract class AbstractNormalizer implements NormalizerInterface
{
    protected $exceptionTypes;

    public function __construct(array $exceptionTypes)
    {
        $this->exceptionTypes = $exceptionTypes;
    }

    public function supports(\Exception $exception)
    {
        return in_array(get_class($exception), $this->exceptionTypes);
    }
}