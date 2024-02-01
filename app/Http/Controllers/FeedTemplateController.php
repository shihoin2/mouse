<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TemplateCollection;
use App\Models\Template;

class FeedTemplateController extends Controller
{
    public function feedTemplates()
    {
        return Template::select('id', 'thumbnail')->paginate(4);
    }
}