<?php

use Carbon\Carbon;

if (!function_exists('format_tanggal_indo')) {
    function format_tanggal_indo($tanggal)
    {
        if (!$tanggal) return '-';
        
        // Pastikan format tanggal valid
        try {
            $date = Carbon::parse($tanggal);
        } catch (\Exception $e) {
            return '-';
        }

        // Format: 12 Januari 2007
        return $date->translatedFormat('d F Y');
    }
}
