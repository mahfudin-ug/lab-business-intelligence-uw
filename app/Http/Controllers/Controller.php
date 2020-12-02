<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function toChartDataset($data, $label, $value, $avg, $castValue=true, $castAvg=true) {
        return [
            'label' => $data->pluck($label)->toArray(),
            'value' => $data->pluck($value)->map( function($item, $key) use ($castValue) { return ($castValue) ? number_format($item, 2) : $item; })->toArray(),
            'avg' => $data->pluck($avg)->map( function($item, $key) use ($castAvg) { return ($castAvg) ? number_format($item, 2) : $item; })->toArray()
        ];
    }
}
