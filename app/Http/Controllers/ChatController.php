<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $userMessage = $request->input('message');
        
        // Setup System Prompt
        $systemPrompt = "Anda adalah asisten pintar untuk website wisata Geosite Balige-Meat-Liang Sipege-Batu Basiha. Anda dapat menjawab SEGALA pertanyaan dari pengguna layaknya mesin pencari, mulai dari pertanyaan umum, ilmu pengetahuan, konversi ukuran (misal berapa kg), lokasi wisata, fasilitas, hingga UMKM. Jika pengguna bertanya hal di luar wisata, tetap jawab dengan pintar dan baik. Namun, selalu tambahkan saran ini di akhir jawaban jika dirasa relevan atau jika Anda sama sekali tidak bisa menjawab: 'Untuk informasi lebih lanjut terkait wisata kami, silakan hubungi admin di WhatsApp 081260000492'. Jawablah dengan ramah, informatif, dan gunakan bahasa Indonesia yang asik.";

        try {
            $response = Http::withoutVerifying()->timeout(15)->withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'openai/gpt-oss-20b',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.5,
                'max_tokens' => 250,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, terjadi kesalahan saat menyusun jawaban.';
                return response()->json(['reply' => $reply]);
            }

            \Log::error('Groq API Error: ' . $response->body());
            return response()->json(['reply' => 'Maaf, layanan AI sedang sibuk atau gangguan. Silakan hubungi admin kami langsung melalui WhatsApp di 081260000492.'], 500);
        } catch (\Exception $e) {
            \Log::error('Groq API Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Maaf, terjadi kesalahan sistem. Silakan hubungi admin kami langsung melalui WhatsApp di 081260000492.'], 500);
        }
    }
}
