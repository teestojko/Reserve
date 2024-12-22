<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationEditController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::all();
        return view('admin.evaluations_index', compact('evaluations'));
    }

    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();
        return back()->with('success', '口コミが削除されました。');
    }
}
