<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgManagerSelfPerception;
use Illuminate\Support\Facades\Redirect;

class feedbackCheckController extends Controller
{
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'id' => 'required|integer'
        ]);

        AgManagerSelfPerception::query()
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', $validatedData['id'])
            ->update(['checkfeedback' => 'S']);

        // Redirecionando com mensagem de sucesso
        return Redirect::route('home')
            ->with('success', 'Feedback enviado com sucesso!');
    }
}
