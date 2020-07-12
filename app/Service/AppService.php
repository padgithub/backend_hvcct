<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Support\DataTablePaginate;

use App\Model\Apps;

class AppService {

    protected $dataTablePaginate;

    public function __construct(DataTablePaginate $dataTablePaginate)
    {
        $this->dataTablePaginate = $dataTablePaginate;
    }

    public function index()
    {
        return DB::table('apps')
            ->select('id', 'name as app_name', 'version_ios', 'version_android', 'prize', 'plan_test', 'plan_show_win')
            ->get()->toArray();

        return  $this->dataTablePaginate->scopeDataTablePaginate($query);
    }

    public function get_name()
    {
        $data = DB::table('apps')
            ->select('name as app_name')->get()->toArray();
        return array_column($data, 'app_name');
    }

    public function store(Request $request)
    {
        return Apps::create($request->all());
    }

    public function show($id)
    {
        return Apps::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $app = Apps::findOrFail($id);
        return $app->update($request->only(
            'name', 'version_ios', 'version_android', 'prize', 'plan_test', 'plan_show_win'
        ));
    }

    public function destroy($id)
    {
        $app = Apps::findOrFail($id);
        return $app->delete();
    }
}
