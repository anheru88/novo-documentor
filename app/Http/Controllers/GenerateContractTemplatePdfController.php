<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use PDF;

class GenerateContractTemplatePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $contract = Template::findOrFail($id);
        $pdf = PDF::loadView('contract', $contract);

        return $pdf->stream('contract-'.$contract->name.'.pdf');

    }
}
