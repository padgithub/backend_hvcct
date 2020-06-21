<?php
namespace App\Service;

use App\Model\Questions;
use App\Support\DataTablePaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Scores;

class ScoreService {

    protected $dataTablePaginate;

    public function __construct(DataTablePaginate $dataTablePaginate)
    {
        $this->dataTablePaginate = $dataTablePaginate;
    }

    public function index()
    {
        return DB::table('scores')
            ->leftJoin('users', 'scores.user_id', '=', 'users.id')
            ->leftJoin('apps', 'scores.app_id', '=', 'apps.id')
            ->select('scores.id', 'users.name as user_name', 'apps.name as app_name', 'scores.point', 'scores.play_times')
            ->get()->toArray();

        return $this->dataTablePaginate->scopeDataTablePaginate($query);
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        foreach ($request->all() as $id) {
            $score = Scores::findOrFail($id);
            $score->delete();
        }
        return true;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $score = Scores::findOrFail($id);

        return $score->update($request->only(
            'point', 'play_times'
        ));
    }

    public function destroy($id)
    {
        $score = Scores::findOrFail($id);
        return $score->delete();
    }
}
