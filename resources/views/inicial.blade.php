<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Maquiveloso – Início</title>
  <link rel="stylesheet" href="{{ asset('output.css') }}">
</head>
<body class="font-sans antialiased">

  <!-- NAVBAR -->
  <nav class="fixed top-0 left-0 w-full h-16 bg-gray-900 text-white flex items-center px-8 shadow-lg z-20">
    <a href="/" class="flex items-center h-full">
      <img src="/imagens/maquiveloso_logo.jpg"
           alt="Logo Maquiveloso"
           class="h-10 w-auto object-contain">
      <span class="ml-3 text-2xl font-bold">Maquiveloso</span>
    </a>
    <div class="flex-1"></div>
    <div class="flex space-x-8 uppercase text-sm font-semibold tracking-wider">
      <a href="/" class="hover:text-gray-400 transition">Início</a>
      <a href="/venda" class="hover:text-gray-400 transition">Catálogo</a>
    </div>
  </nav>

  <!-- HERO -->
  <section
    class="relative h-screen w-full bg-cover bg-center"
    style="background-image:url('/imagens/pai-trabalhando.jpg')"
  >
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
      <h1 class="text-6xl md:text-7xl lg:text-8xl font-cursive text-white drop-shadow-xl">
        Maquiveloso
      </h1>
      <p class="mt-4 text-lg text-gray-200">
        Venda e Reparação de Máquinas de Costura
      </p>
      <a
        href="#contactos"
        class="mt-8 inline-block px-8 py-4 bg-amber-500 hover:bg-amber-600 text-white uppercase font-semibold rounded-lg transition"
      >
        Entrar em contacto
      </a>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="max-w-5xl mx-auto px-6 py-16 space-y-16">


    <!-- SERVIÇOS PRESTADOS -->
    <section class="max-w-5xl mx-auto px-6 py-16">
      <div class="md:flex md:items-center md:space-x-12">
        <div class="md:w-1/2">
          <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Serviços Prestados</h2>
          <div class="w-20 h-1 bg-amber-500 mb-6"></div>
          <p class="text-gray-700 text-lg leading-relaxed mb-4">
            Realizamos reparação de máquinas de costura industriais e domésticas.  
            Também vendemos equipamentos com garantia, assistência técnica especializada e aconselhamento personalizado.
          </p>
          <p class="text-gray-700 text-lg leading-relaxed">
            Trabalhamos com peças originais e sob medida, garantindo durabilidade e performance.  
            Cada cliente recebe um atendimento único, do orçamento à entrega.
          </p>
        </div>
        <div class="md:w-1/2 mt-8 md:mt-0 overflow-hidden rounded-xl shadow-lg">
          <img
            src="/imagens/servicos_maquina.jpg"
            class="w-full h-[350px] object-cover object-center"
          >
        </div>
      </div>
    </section>

  </main>

  <!-- CONTACTOS -->
  <section
    id="contactos"
    class="relative bg-cover bg-center py-16"
    style="background-image:url('/imagens/pai-trabalhando.jpg')"
  >
    <div class="absolute inset-0 bg-black bg-opacity-75"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white space-y-8">

      <!-- Título -->
      <h2 class="text-4xl md:text-5xl font-bold uppercase tracking-wide">Contactos</h2>

      <!-- Lista de contactos em duas colunas -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-lg md:text-xl">
        <div class="space-y-4 text-left text-amber-400 font-semibold">
          <p>Email</p>
          <p>Telefone</p>
          <p>Morada</p>
        </div>
        <div class="space-y-4 text-left">
          <p>
            <a href="mailto:exemplo@maquiveloso.pt"
               class="hover:underline">maquiveloso@sapo.pt</a>
          </p>
          <p>
            <a href="tel:+351912345678"
               class="hover:underline">914 050 099</a>
          </p>
            <p class="text-white">
                Rua Ponte de Mazagão, nº 10 – Aveleda<br>
                4705-073 Braga
            </p>
        </div>
      </div>

      <!-- Botão de ação -->
      <a
        href="mailto:exemplo@maquiveloso.pt"
        class="inline-block mt-8 px-10 py-4 bg-amber-500 hover:bg-amber-600 uppercase font-semibold rounded-lg transition"
      >
        Enviar Email
      </a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-gray-900 text-gray-300">
    <div class="max-w-5xl mx-auto px-6 py-6 flex flex-col sm:flex-row justify-between items-center text-sm">
      <p>&copy; {{ date('Y') }} Maquiveloso. Todos os direitos reservados.</p>
      <p>Desenvolvido em Laravel + Tailwind CSS</p>
    </div>
  </footer>

</body>
</html>
