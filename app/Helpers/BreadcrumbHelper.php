<?php

namespace App\Helpers;

class BreadcrumbHelper
{
    public static function generateBreadcrumb()
    {
        // Ambil segmen URL saat ini
        $segments = request()->segments();

        // Buat breadcrumb berdasarkan segmen
        $breadcrumb = [];
        $url = '';
        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumb[] = [
                'name' => ucfirst(str_replace('-', ' ', $segment)),
                'url' => $url,
            ];
        }

        return $breadcrumb;
    }
}