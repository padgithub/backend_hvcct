<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Support\DataTablePaginate;

use App\Model\Questions;

class QuestionService {

    protected $dataTablePaginate;

    public function __construct(DataTablePaginate $dataTablePaginate)
    {
        $this->dataTablePaginate = $dataTablePaginate;
    }

    public function index($params = null)
    {
        $ids = $params->only('ids');
        if (!empty($ids)) {
            $explode = explode(',', $ids['ids']);
            return DB::table('questions')
                ->leftJoin('apps', 'questions.app_id', '=', 'apps.id')
                ->where('questions.app_id', '!=', '')
                ->whereIn('questions.id', $explode)
                ->select('questions.id', 'apps.name as app_name', 'questions.details', 'questions.a', 'questions.b', 'questions.c', 'questions.d', 'questions.answer')
                ->get()->toArray();
        }
        return DB::table('questions')
            ->leftJoin('apps', 'questions.app_id', '=', 'apps.id')
            ->where('questions.app_id', '!=', '')
            ->select('questions.id', 'apps.name as app_name', 'questions.details', 'questions.a', 'questions.b', 'questions.c', 'questions.d', 'questions.answer')
            ->get()->toArray();

        return $this->dataTablePaginate->scopeDataTablePaginate($query);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $app_id     = DB::table('apps')->select('id')->where('name', $params['app_name'])->first();
        $params['app_id'] = $app_id->id ?? '';
        unset($params['app_name']);
        return Questions::create($params);
    }

    public function show($id)
    {
        return Questions::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $question = Questions::findOrFail($id);

        return $question->update($request->only(
            'details', 'a', 'b', 'c', 'd', 'answer'
        ));
    }

    public function destroy($id)
    {
        $question = Questions::findOrFail($id);
        return $question->delete();
    }

    public function randomQuestion() {
        return DB::table('questions')
            ->leftJoin('apps', 'questions.app_id', '=', 'apps.id')
            ->where('questions.app_id', '!=', '')
            ->select('questions.id', 'apps.name as app_name', 'questions.details', 'questions.a', 'questions.b', 'questions.c', 'questions.d', 'questions.answer')
            ->inRandomOrder()
            ->limit(20)
            ->get()->toArray();

        return $this->dataTablePaginate->scopeDataTablePaginate($query);
    }
}
