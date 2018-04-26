<?php

namespace Eccube\Twig\Extension;


use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class IntlExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('date_day', [$this, 'date_day'], ['needs_environment' => true]),
            new TwigFilter('date_min', [$this, 'date_min'], ['needs_environment' => true]),
        ];
    }

    /**
     * localizeddate('medium', 'none')のショートカット.
     *
     * 2015/08/28のように、日までのフォーマットで表示します(localeがjaの場合).
     * null,空文字に対して利用した場合は、空文字を返却します.
     *
     * @param Environment $env
     * @param $date
     * @return bool|string
     */
    public function date_day(Environment $env, $date)
    {
        if (!$date) {
            return '';
        }

        return \twig_localized_date_filter($env, $date, 'medium', 'none');
    }

    /**
     * localizeddate('medium', 'short')のショートカット.
     *
     * 2015/08/28 16:13のように、分までのフォーマットで表示します(localeがjaの場合).
     * null,空文字に対して利用した場合は、空文字を返却します.
     *
     * @param Environment $env
     * @param $date
     * @return bool|string
     */
    public function date_min(Environment $env, $date)
    {
        if (!$date) {
            return '';
        }

        return \twig_localized_date_filter($env, $date, 'medium', 'short');
    }
}