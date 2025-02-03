<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class ImportController extends Controller
{

    public function showImport()
    {
        return view('admin.import');
    }

    public function store(CsvImportRequest $request)
    {
        $csv = Reader::createFromPath($request->file('csv_file')->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            $prefecture = Prefecture::where('name', $record['地域'])->first();
            $genre = Genre::where('name', $record['ジャンル'])->first();

            if (!$prefecture || !$genre) {
                continue;
            }

            Shop::create([
                'name' => $record['店舗名'],
                'prefecture_id' => $prefecture->id,
                'genre_id' => $genre->id,
                'detail' => $record['店舗概要'],
                'image_path' => $record['画像URL'],
            ]);
        }

        return back()->with('success', 'CSVインポートが完了しました。');
    }

}


