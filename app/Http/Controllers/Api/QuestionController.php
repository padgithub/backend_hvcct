<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\QuestionService;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\ExportQuestions;
use App\Import\ImportQuestions;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        //
        $this->questionService = $questionService;
    }

    public function index(Request $request)
    {
        //
        return $this->respondSuccess($this->questionService->index($request));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->respondSuccess($this->questionService->store($request));
    }

    public function show($id)
    {
        return $this->respondSuccess($this->questionService->show($id));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->respondSuccess($this->questionService->update($request, $id));
    }

    public function destroy($id)
    {
        return $this->respondSuccess($this->questionService->destroy($id));
    }


    public function exportTemplate()
    {
        return view('Template_default');
    }

    public function export()
    {
        return Excel::download(new ExportQuestions, 'questions.xlsx');
    }

    public function import(Request $request)
    {
        return $this->respondSuccess(Excel::import(new ImportQuestions, request()->file('file')));
    }

    public function randomQuesttion() {
        return $this->respondSuccess($this->questionService->randomQuestion());
    }

}
