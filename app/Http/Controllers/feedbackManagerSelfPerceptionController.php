<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgManagerSelfPerception;
use Illuminate\Support\Facades\Redirect;

class FeedbackManagerSelfPerceptionController extends Controller
{
    public function store(Request $request)
    {
        // Validando os dados de entrada
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'percepcao' => 'required|string|max:500'
        ]);

        // Criando o registro no banco de dados
        AgManagerSelfPerception::create([
            'AG_FEEDBACK_SEMESTRAL_SUPERVISAO' => $validatedData['id'],
            'AUTO_PERCEPCAO' => $validatedData['percepcao']
        ]);

        // Redirecionando com mensagem de sucesso
        return Redirect::route('feedbackReportController.index', ['id' => $validatedData['id']])
            ->with('success', 'Feedback enviado com sucesso!');
    }
}
