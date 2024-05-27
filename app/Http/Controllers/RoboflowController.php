<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\TrueType;

class RoboflowController extends Controller
{
    public function checkApiConnection()
    {

        $url = 'https://api.roboflow.com/https://detect.roboflow.com/tilapia-diseases/1?api_key=AaxVQyfDGfG11CPPcsG1';
        $apiKey = 'AaxVQyfDGfG11CPPcsG1';

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ])->get($url);

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'API connection is successful',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to connect to API',
                    'response' => $response->body(),
                ], $response->status());
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function processImage(Request $request)
{
    $url = 'https://api.roboflow.com/https://detect.roboflow.com/tilapia-diseases/1?api_key=AaxVQyfDGfG11CPPcsG1';
    $apiKey = 'AaxVQyfDGfG11CPPcsG1';

    try {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Accept' => 'application/json',
        ])->attach('image', $request->file('image')->path(), $request->file('image')->getClientOriginalName())
          ->post($url);


        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'data' => $response->json(),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process image',
                'response' => $response->body(),
            ], $response->status());
        }

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $imageContent = file_get_contents($image->getPathname());

        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('diagnosa_output'), $imageName);

        $imageDataPath = public_path('diagnosa_output/' . $imageName);
        $pythonScript = public_path('diagnosa_output/diagnosa.py');

        $descriptorspec = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"]
        ];

        $process = proc_open("python $pythonScript $imageDataPath", $descriptorspec, $pipes);

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            proc_close($process);

            $startPos = strpos($output, "{");
            $endPos = strrpos($output, "}");

            $relevantOutput = substr($output, $startPos, $endPos - $startPos + 1);
            $relevantOutputJSON = json_decode($relevantOutput, true);

            if (isset($relevantOutputJSON['predictions'])) {
                $predictions = $relevantOutputJSON['predictions'];
                $classes = [];
                foreach ($predictions as $prediction) {
                    if (isset($prediction['class'])) {
                        $classes[] = $prediction['class'];
                    }
                }

                // Simpan hasil ke database
                $username = $request->session()->get('username');
                $diagnosis = new Diagnosis();
                $diagnosis->username = $username;
                $diagnosis->image = $imageContent;
                $diagnosis->results = $classes;
                $diagnosis->save();

                return view('diagnosa_output', ['data' => $classes, 'imageName' => $imageName]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No predictions found.'
                ], 500);
            }
        }
    }

    public function showHistory(Request $request)
    {
        $username = $request->session()->get('username');
        $diagnoses = Diagnosis::where('username', $username)->get();

        return view('riwayatdiagnosis', ['diagnoses' => $diagnoses]);
    }

    public function delete($id)
    {
        $diagnosis = Diagnosis::find($id);
        if ($diagnosis) {
            $diagnosis->delete();
            return response()->json(['status' => 'success', 'message' => 'Riwayat Diagnosis berhasil dihapus']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Terjadi Eror, silahkan ulang kembali'], 404);
        }
    }
}


