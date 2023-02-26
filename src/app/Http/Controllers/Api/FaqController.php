<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index($id = null)
    {
        if ($id == null) {

            $faq = Faq::with(['createdBy','updatedBy'])->where('status', 'Active')->latest()->get();
            if (count($faq) > 0) {
                return $this->ResponseWithSuccess("All faqs get successfully", 200, $faq);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
        } else {
            $faq = Faq::with(['createdBy', 'updatedBy'])->where('id', $id)->where('status', 'Active')->first();
            if ($faq) {
                return $this->ResponseWithSuccess("Faq get successfully", 200, $faq);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }



}
