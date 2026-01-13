<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LeaderboardController extends Controller
{

    public function index()
    {
        $filePath = storage_path('app/data_absensi.xlsx');

        if (!file_exists($filePath)) {
            return "File Excel tidak ditemukan. Pastikan file dari Spreadsheet sudah di-copy ke storage/app/data_absensi.xlsx";
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $karyawanScores = [];

        // Mulai dari baris ke-2 (index 1) untuk melewati header
        foreach (array_slice($data, 1) as $row) {
            $nama = $row[1] ?? null; // Kolom Nama
            $poin = isset($row[2]) ? (int)$row[2] : 0; // Kolom Poin langsung

            if ($nama) {
                $karyawanScores[$nama] = ($karyawanScores[$nama] ?? 0) + $poin;
            }
        }

        arsort($karyawanScores);

        $rankedData = [];
        foreach ($karyawanScores as $name => $score) {
            $rankedData[] = [
                'name' => $name,
                'score' => $score,
                'image' => "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff"
            ];
        }

        $top5 = array_slice($rankedData, 0, 5);
        $others = array_slice($rankedData, 5);

        return view('leaderboard', compact('top5', 'others'));
    }

// public function index()
    // {
    //     $filePath = storage_path('app/data_absensi.xlsx');
    //     $spreadsheet = IOFactory::load($filePath);
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $data = $sheet->toArray();

    //     $pointsTable = [1 => 5, 2 => 4, 3 => 3, 4 => 2, 5 => 1];
    //     $karyawanScores = [];

    //     foreach (array_slice($data, 1) as $row) {
    //         $nama = $row[1]; // Kolom Nama
    //         $posisi = (int)$row[2]; // Kolom Posisi

    //         if (isset($pointsTable[$posisi])) {
    //             $karyawanScores[$nama] = ($karyawanScores[$nama] ?? 0) + $pointsTable[$posisi];
    //         }
    //     }

    //     arsort($karyawanScores);

    //     $rankedData = [];
    //     foreach ($karyawanScores as $name => $score) {
    //         $imagePath = 'images/' . $name . '.jpg';

    //         if (file_exists(public_path($imagePath))) {
    //             $photo = asset($imagePath);
    //         } else {
    //             $photo = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff";
    //         }

    //         $rankedData[] = [
    //             'name' => $name,
    //             'score' => $score,
    //             'image' => $photo
    //         ];
    //     }

    //     $top5 = array_slice($rankedData, 0, 5);
    //     $others = array_slice($rankedData, 5);

    //     return view('leaderboard', compact('top5', 'others'));
    // }
}
