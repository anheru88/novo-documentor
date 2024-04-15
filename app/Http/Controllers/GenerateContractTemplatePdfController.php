<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GenerateContractTemplatePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $contract = Contract::findOrFail($id);

        $pdf = Pdf::loadView('contract', $contract);
        return $pdf->download('invoice.pdf');

    }
}
