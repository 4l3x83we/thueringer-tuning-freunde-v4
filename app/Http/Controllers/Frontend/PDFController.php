<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PDFController.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 10:26
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function veranstaltungen(Request $request)
    {
        $veranstaltungens = Veranstaltungen::where('datum_bis', '>=', now())->orderBy('datum_von', 'ASC')->get();

        if ($request->has('download') && $request->get('download') === 'pdf') {
            $pdf = Pdf::loadView('frontend.component.veranstaltungen.index-list', compact('veranstaltungens'))->setPaper('A4', 'landscape');
            return $pdf->download('Veranstaltungen.pdf');
        }

        return view('frontend.index.veranstaltungen', compact('veranstaltungens'));
    }
}
