<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BukuCard extends Component
{
    public $buku;

    public function __construct($buku)
    {
        $this->buku = $buku;
    }

    public function render()
    {
        return view('components.buku-card');
    }
}