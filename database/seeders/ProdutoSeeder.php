<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;


class ProdutoSeeder extends Seeder
{


public function run()


{
        \App\Models\Produto::truncate();

    Produto::create([
        'nome' => 'Máquina Overlock C5F - Jack',
        'descricao' => 'Modelo eletrônico, ideal para produção industrial.',
        'preco' => 7990,
        'imagem' => 'maquina1.jpg',
        'disponivel' => true,
    ]);

    Produto::create([
        'nome' => 'Máquina Overlock C4 - Jack',
        'descricao' => 'Alta performance com desconto especial.',
        'preco' => 6190,
        'imagem' => 'maquina2.jpg',
        'disponivel' => false,
    ]);

    Produto::create([
        'nome' => 'Máquina de Corte de Faca 6 polegadas - Jack',
        'descricao' => 'Compacta e eficiente para tecidos grossos.',
        'preco' => 3190,
        'imagem' => 'maquina3.jpg',
        'disponivel' => true,
    ]);

    Produto::create([
    'nome'       => 'Singer Heavy Duty 4411',
    'descricao'  => 'Estrutura metálica robusta, velocidade até 1.100 pontos por minuto e 6 pontos básicos.',
    'preco'      => 251.67,
    'imagem'     => 'maquina3.jpg',
    'disponivel' => true,
]);

Produto::create([
    'nome'       => 'Brother FS40',
    'descricao'  => 'Máquina eletrónica com 40 programas de pontos, controle de velocidade sem pedal e bobina drop-in.',
    'preco'      => 259.00,
    'imagem'     => 'maquina2.jpg',
    'disponivel' => true,
]);

Produto::create([
    'nome'       => 'Bernina 325',
    'descricao'  => 'Modelo suíço entry-level com 97 pontos, enchedor automático de bobina e braço livre.',
    'preco'      => 1199.00,
    'imagem'     => 'maquina1.jpg',
    'disponivel' => true,
]);

Produto::create([
    'nome'       => 'Juki DDL-8700',
    'descricao'  => 'Máquina industrial de ponto reto, com cortador automático de linha e 5.500 sti/min.',
    'preco'      => 999.00,
    'imagem'     => 'maquina2.jpg',
    'disponivel' => true,
]);

Produto::create([
    'nome'       => 'Pfaff Passport 2.0',
    'descricao'  => 'Compacta e leve, com IDT integrado e 70 pontos predefinidos.',
    'preco'      => 659.00,
    'imagem'     => 'maquina1.jpg',
    'disponivel' => true,
]);

Produto::create([
    'nome'       => 'Elna eXcellence 680+',
    'descricao'  => 'Máquina computadorizada com 170 pontos, grande área de costura e braço livre.',
    'preco'      => 1367.00,
    'imagem'     => 'maquina3.jpg',
    'disponivel' => true,
]);
}

}
