<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 07/12/2017
 * Time: 12:27
 */

namespace AppBundle\Normalizer;


Interface NormalizerInterface
{
    public function normalize(\Exception $exception);

    public function supports(\Exception $exception);
}