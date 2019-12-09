<?php

namespace Clevyr\VoyagerBlog\Fields;

use TCG\Voyager\FormFields\AbstractHandler;

class GutenburgField extends AbstractHandler
{
    protected $codename = 'Gutenburg';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('fields.gutenburg', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
