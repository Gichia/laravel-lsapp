<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Home
    public function index() {
        $title = "Welcome to Laravel";
        return view("pages.index")->with("title", $title);
    }

    // About
    public function about() {
        $title = "About Laravel";
        return view("pages.about")->with("title", $title);
    }

    // Services
    public function services() {
        $data = array(
            "title" => "Our Services",
            "services" => ["Web Design", "Graphic Design", "SEO"]
        );
        return view("pages.services")->with($data);
    }
}
