<?php

namespace App\View\Components;

class FlatPickr extends \BladeUIKit\Components\Forms\Inputs\FlatPickr
{
    public function options(): array
    {
        return array_merge([
            'altInput' => true,
            'altFormat'=> "Y-m-d H:i",
            'dateFormat'=> "Y-m-d H:i",
            'time_24hr' => true,
        ], parent::options());
    }
}