<?php


namespace App\twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('dateDiff', [$this, 'differenceDate']),
        ];
    }

    public function differenceDate( $date1,  $date2)
    {

        $diff=$date2->diff($date1);
        return $diff->s . " sec";
    }
}