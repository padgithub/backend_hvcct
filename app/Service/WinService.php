<?php
namespace App\Service;

use App\Support\DataTablePaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Users;
use App\Model\Wins;

class WinService {

    protected $dataTablePaginate;

    public function __construct(DataTablePaginate $dataTablePaginate)
    {
        $this->dataTablePaginate = $dataTablePaginate;
    }

    public function index()
    {
        return DB::table('wins')
            ->leftJoin('users', 'wins.user_id', '=', 'users.id')
            ->leftJoin('apps', 'wins.app_id', '=', 'apps.id')
            ->select('wins.id', 'users.name as user_name', 'apps.name as app_name', 'wins.prize', 'wins.plan_test')
            ->get()->toArray();

        return $this->dataTablePaginate->scopeDataTablePaginate($query);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params     = $request->all();
        $user_id    = DB::table('users')->select('id')->where('name', $params['user_name'])->first();
        $app_id     = DB::table('apps')->select('id')->where('name', $params['app_name'])->first();

        $params['app_id'] = $app_id->id ?? '';
        $params['user_id'] = $user_id->id ?? '';
        unset(
            $params['user_name'],
            $params['app_name']
        );

        return Wins::create($params);
    }

    public function show($id)
    {
        return Wins::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $win = Wins::findOrFail($id);

        return $win->update($request->only(
            'prize', 'plan_test'
        ));
    }

    public function destroy($id)
    {
        $win = Wins::findOrFail($id);
        return $win->delete();
    }
}
