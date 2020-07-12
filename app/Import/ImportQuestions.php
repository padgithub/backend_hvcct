<?php

namespace App\Import;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Model\Questions;

class ImportQuestions implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     * @return Questions
     */
    public function model(array $row)
    {
        # Search data isset
        $data_update = DB::table('questions')
            ->where('questions.app_id', '=', $row['id_app'])
            ->where('questions.details', '=', $row['question'])
            ->select('questions.id')
            ->first();
        # It has delete data old
        if ($data_update) {
            $question = Questions::findOrFail($data_update->id);
            $question->delete();
        }

        return new Questions([
            'app_id'    => $row['id_app'],
            'details'   => $row['question'],
            'a'         => $row['answer_a'],
            'b'         => $row['answer_b'],
            'c'         => $row['answer_c'],
            'd'         => $row['answer_d'],
            'answer'    => $row['result'],
        ]);
    }
}
