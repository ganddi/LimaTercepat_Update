<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $spreadsheetId = '1P5P_10CxCVBZqLHWvvJbtSCMibI1PziIZKw31nyvYvQ';
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google-access.json'));
        $client->addScope('https://www.googleapis.com/auth/spreadsheets.readonly');
        $service = new Sheets($client);

        try {
            // 1. Ambil Nama Pegawai (Sheet Master)
            $rangeNama = 'Nama Pegawai!A2:A60';
            $resNama = $service->spreadsheets_values->get($spreadsheetId, $rangeNama);
            $allEmployeesRaw = $resNama->getValues() ?? [];

            $karyawanData = [];
            foreach ($allEmployeesRaw as $row) {
                $nama = trim($row[0] ?? '');
                if ($nama) {
                    $karyawanData[$nama] = 0; // Inisialisasi poin 0
                }
            }

            // 2. Ambil Poin dari Sheet1 (Data Absensi)
            $rangePoin = 'Sheet1!B2:C500';
            $resPoin = $service->spreadsheets_values->get($spreadsheetId, $rangePoin);
            $attendanceData = $resPoin->getValues() ?? [];

            foreach ($attendanceData as $row) {
                $namaHadir = trim($row[0] ?? '');
                $poin = (int)($row[1] ?? 0);
                if (isset($karyawanData[$namaHadir])) {
                    $karyawanData[$namaHadir] += $poin;
                }
            }

            // 3. Urutkan berdasarkan skor tertinggi
            arsort($karyawanData);

            // 4. Mapping untuk View (Cek Foto di Folder Lokal)
            $rankedData = [];
            foreach ($karyawanData as $name => $score) {
                // Tentukan path file di public/images/karyawan/
                $imagePathJpg = 'images/' . $name . '.jpg';
                $imagePathPng = 'images/' . $name . '.png';

                if (file_exists(public_path($imagePathJpg))) {
                    $photoUrl = asset($imagePathJpg);
                } elseif (file_exists(public_path($imagePathPng))) {
                    $photoUrl = asset($imagePathPng);
                } else {
                    // Jika tidak ada foto di folder, pakai UI Avatars
                    $photoUrl = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff";
                }

                $rankedData[] = [
                    'name' => $name,
                    'score' => $score,
                    'image' => $photoUrl,
                    'username' => '@' . strtolower(str_replace(' ', '_', $name))
                ];
            }

            $top5 = array_slice($rankedData, 0, 5);
            $others = array_slice($rankedData, 5);

            return view('leaderboard', compact('top5', 'others'));
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
