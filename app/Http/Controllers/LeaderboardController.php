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
            return "File Excel tidak ditemukan di storage/app/data_absensi.xlsx";
        }

        $spreadsheet = IOFactory::load($filePath);

        $employeeSheet = $spreadsheet->getSheetByName('Nama Pegawai');
        $allEmployeesRaw = $employeeSheet->toArray();
        $karyawanScores = [];

        foreach (array_slice($allEmployeesRaw, 1) as $row) {
            $namaMaster = $row[0] ?? null; 
            if ($namaMaster) {
                $karyawanScores[trim($namaMaster)] = 0;
            }
        }
        $pointsSheet = $spreadsheet->getSheetByName('Sheet1');
        $attendanceData = $pointsSheet->toArray();

        foreach (array_slice($attendanceData, 1) as $row) {
            $namaHadir = $row[1] ?? null; 
            $poin = isset($row[2]) ? (int)$row[2] : 0;

            if ($namaHadir) {
                $namaHadir = trim($namaHadir);
                if (isset($karyawanScores[$namaHadir])) {
                    $karyawanScores[$namaHadir] += $poin;
                } else {
                    $karyawanScores[$namaHadir] = $poin;
                }
            }
        }
        array_multisort(array_values($karyawanScores), SORT_DESC, array_keys($karyawanScores), SORT_ASC, $karyawanScores);
        $rankedData = [];
        foreach ($karyawanScores as $name => $score) {
            $imagePath = 'images/' . $name . '.jpg';

            if (file_exists(public_path($imagePath))) {
                $photo = asset($imagePath);
            } else {
                $photo = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff";
            }

            $rankedData[] = [
                'name' => $name,
                'score' => $score,
                'image' => $photo
            ];
        }

        $top5 = array_slice($rankedData, 0, 5);
        $others = array_slice($rankedData, 5);

        return view('leaderboard', compact('top5', 'others'));
    }
}
