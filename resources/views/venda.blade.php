<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Catálogo | Maquiveloso</title>
  <link rel="stylesheet" href="{{ asset('output.css') }}">
</head>
<body class="font-sans antialiased">

  <!-- NAVBAR -->
  <nav class="fixed top-0 left-0 w-full h-16 bg-gray-900 text-white flex items-center px-8 shadow-lg z-20">
    <!-- Logo -->
    <a href="/" class="flex items-center h-full">
      <img src="/imagens/maquiveloso_logo.jpg"
           alt="Logo Maquiveloso"
           class="h-10 w-auto object-contain">
      <span class="ml-3 text-2xl font-bold">Maquiveloso</span>
    </a>

    <!-- Search form -->
    <form method="GET"
          action="{{ route('venda') }}"
          class="ml-8 flex items-center bg-gray-900 rounded-lg border border-gray-700 overflow-hidden">
      <input
        type="search"
        name="search"
        value="{{ request('search') }}"
        placeholder="Procurar"
        class="px-3 py-2 bg-gray-900 text-gray-200 placeholder-gray-500 focus:outline-none"
      >
      <button
        type="submit"
        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white uppercase font-semibold transition"
      >
        Procurar
      </button>
    </form>

    <!-- Links -->
    <div class="ml-auto flex space-x-8 uppercase text-sm font-semibold tracking-wider">
      <a href="/" class="hover:text-gray-400 transition">Início</a>
      <a href="{{ route('venda') }}" class="hover:text-gray-400 transition">Catálogo</a>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-20 max-w-7xl mx-auto px-6 pb-20 space-y-16">

    <!-- HEADER -->
    <header class="text-center py-10 bg-white rounded-2xl shadow-lg">
      <h1 class="text-5xl font-bold text-gray-900 uppercase tracking-wide">
        Catálogo de Máquinas de Costura
      </h1>
      <p class="text-gray-600 mt-2">Descubra os nossos modelos disponíveis</p>
    </header>

    <!-- CATÁLOGO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      @forelse($produtos as $produto)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col items-center">
          <div class="flex justify-center items-center h-48 w-full overflow-hidden mb-4">
            <img src="{{ asset('imagens/' . $produto->imagem) }}"
                 alt="{{ $produto->nome }}"
                 class="object-contain max-h-40 w-auto">
          </div>

          <h2 class="text-lg font-semibold text-gray-900 text-center">
            {{ $produto->nome }}
          </h2>

          <p class="text-gray-600 text-sm text-center mt-1 mb-2">
            {{ Str::limit($produto->descricao, 60) }}
          </p>

          <div class="text-xl font-bold text-gray-900 mt-auto">
            €{{ number_format($produto->preco, 2, ',', '.') }}
          </div>

          <div class="mt-3">
            @if($produto->disponivel)
              <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                Disponível
              </span>
            @else
              <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                Esgotado
              </span>
            @endif
          </div>
        </div>
      @empty
        <p class="col-span-3 text-center text-gray-500">Nenhuma máquina encontrada.</p>
      @endforelse
    </div>

  </main>

</body>
</html>

