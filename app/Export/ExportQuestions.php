<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Model\Questions;

class ExportQuestions implements FromCollection
{

    public function collection()
    {
        return Questions::get();
    }
}
