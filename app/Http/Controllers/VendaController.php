<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($search = $request->input('search')) {
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%");
        }

        $produtos = $query->get(); // ou paginate(9)
        return view('venda', compact('produtos'));
    }
}
