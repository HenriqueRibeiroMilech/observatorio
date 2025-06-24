<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Observatório</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Header Fixo -->
    <div class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Observatório Serra Gaúcha</h1>
                    <p class="text-xs text-gray-500">Dashboard de Análise de Dados</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Select de Navegação -->
                    <select 
                        id="navegacaoSelect" 
                        onchange="navegarPara(this.value)"
                        class="px-3 py-2 bg-white border border-gray-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">📊 Navegar para...</option>
                        <option value="perfil-visitante">👤 Perfil do Visitante</option>
                        <option value="origem">🌍 Origem</option>
                        <option value="conhecimento-previo">💡 Conhecimento Prévio</option>
                        <option value="acompanhantes">👥 Acompanhantes</option>
                        <option value="organizacao-viagem">📋 Organização da Viagem</option>
                        <option value="motivacao-interesses">🎯 Motivação e Interesses</option>
                        <option value="duracao-viagem">⏱️ Duração da Viagem</option>
                        <option value="transporte">🚗 Transporte</option>
                        <option value="gasto-diario">💰 Gasto Diário</option>
                        <option value="satisfacao">⭐ Nível de Satisfação</option>
                    </select>
                    <!-- Input de ID -->
                    <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-1">
                        <input
                            type="number"
                            id="idInput"
                            value="{{ $id }}"
                            placeholder="Digite o ID"
                            class="w-24 px-3 py-2 bg-white border border-gray-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button
                            onclick="trocarId()"
                            class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                            🔍 Analisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(isset($erro))
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <div class="text-red-800">{{ $erro }}</div>
        </div>
        @else

        <!-- PERFIL DO VISITANTE -->
        <section id="perfil-visitante" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">👤 Perfil do Visitante</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Distribuição por Gênero</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['genero']->container() !!}
                        </div>
                    </div>
                </div>

                @if(isset($graficos['faixaEtaria']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Distribuição por Faixa Etária</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['faixaEtaria']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['formacaoEscolar']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Distribuição por Formação Escolar</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['formacaoEscolar']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['rendaPessoal']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Distribuição por Renda Pessoal</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['rendaPessoal']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['profissoes']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Distribuição por Profissão</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['profissoes']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- ORIGEM -->
        <section id="origem" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">🌍 Origem</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-green-500 to-blue-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['paisPizza']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">País de Residência (Pizza)</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['paisPizza']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['paisBarra']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">País de Residência (Barras)</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['paisBarra']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['estadosPizza']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Estados de Origem (Pizza)</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['estadosPizza']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['estadosBarra']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Estados de Origem (Barras)</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['estadosBarra']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['municipios']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Município de Residência</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['municipios']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- CONHECIMENTO PRÉVIO DO DESTINO -->
        <section id="conhecimento-previo" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">💡 Conhecimento Prévio do Destino</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-yellow-500 to-orange-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['conhecimentoPrevio']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Conhecimento Prévio do Destino</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['conhecimentoPrevio']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['fontesReferencia']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Fontes de Referência</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['fontesReferencia']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- ACOMPANHANTES -->
        <section id="acompanhantes" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">👥 Acompanhantes</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-purple-500 to-pink-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['perfilViajantes']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Perfil dos Viajantes</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['perfilViajantes']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['quantidadeViajantes']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quantidade de Viajantes</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['quantidadeViajantes']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- ORGANIZAÇÃO DA VIAGEM -->
        <section id="organizacao-viagem" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">📋 Organização da Viagem</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['organizacaoViagem']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Organização da Viagem</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['organizacaoViagem']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['outrosOrganizadores']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Outros Organizadores</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['outrosOrganizadores']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- MOTIVAÇÃO E INTERESSES -->
        <section id="motivacao-interesses" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">🎯 Motivação e Interesses</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-red-500 to-pink-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['motivacao']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Motivação Principal</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['motivacao']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['interesses']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Interesses na Viagem</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['interesses']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- DURAÇÃO DA VIAGEM -->
        <section id="duracao-viagem" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">⏱️ Duração da Viagem (Em dias)</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-cyan-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['duracaoViagem']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Duração da Viagem</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['duracaoViagem']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- TRANSPORTE -->
        <section id="transporte" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">🚗 Transporte</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-gray-500 to-gray-700 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['acesso']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acesso ao Destino</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['acesso']->container() !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($graficos['transporteDestino']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Transporte no Destino</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['transporteDestino']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- GASTO DIÁRIO POR PESSOA -->
        <section id="gasto-diario" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">💰 Gasto Diário por Pessoa</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-emerald-500 to-green-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['gastoDiarioPorPessoa']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Gasto Diário por Pessoa</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['gastoDiarioPorPessoa']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- NÍVEL DE SATISFAÇÃO -->
        <section id="satisfacao" class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">⭐ Nível de Satisfação Geral com o Destino</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-amber-500 to-yellow-600 rounded"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @if(isset($graficos['nota']))
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Nota Geral</h3>
                    </div>
                    <div class="p-6">
                        <div style="height: 450px;">
                            {!! $graficos['nota']->container() !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        @endif
    </div>

    @if(!isset($erro))
    @if(isset($graficos['faixaEtaria']))
    {!! $graficos['genero']->script() !!}
    @endif

    @if(isset($graficos['faixaEtaria']))
    {!! $graficos['faixaEtaria']->script() !!}
    @endif

    @if(isset($graficos['formacaoEscolar']))
    {!! $graficos['formacaoEscolar']->script() !!}
    @endif

    @if(isset($graficos['rendaPessoal']))
    {!! $graficos['rendaPessoal']->script() !!}
    @endif

    @if(isset($graficos['profissoes']))
    {!! $graficos['profissoes']->script() !!}
    @endif

    @if(isset($graficos['estadosBarra']))
    {!! $graficos['estadosBarra']->script() !!}
    @endif
    
    @if(isset($graficos['estadosPizza']))
    {!! $graficos['estadosPizza']->script() !!}
    @endif

    @if(isset($graficos['paisPizza']))
    {!! $graficos['paisPizza']->script() !!}
    @endif
    
    @if(isset($graficos['paisBarra']))
    {!! $graficos['paisBarra']->script() !!}
    @endif
    
    @if(isset($graficos['municipios']))
    {!! $graficos['municipios']->script() !!}
    @endif
    
    @if(isset($graficos['perfilViajantes']))
    {!! $graficos['perfilViajantes']->script() !!}
    @endif

    @if(isset($graficos['quantidadeViajantes']))
    {!! $graficos['quantidadeViajantes']->script() !!}
    @endif

    @if(isset($graficos['conhecimentoPrevio']))
    {!! $graficos['conhecimentoPrevio']->script() !!}
    @endif

    @if(isset($graficos['fontesReferencia']))
    {!! $graficos['fontesReferencia']->script() !!}
    @endif
    
    @if(isset($graficos['interesses']))
    {!! $graficos['interesses']->script() !!}
    @endif

    @if(isset($graficos['motivacao']))
    {!! $graficos['motivacao']->script() !!}
    @endif

    @if(isset($graficos['duracaoViagem']))
    {!! $graficos['duracaoViagem']->script() !!}
    @endif

    @if(isset($graficos['gastoDiarioPorPessoa']))
    {!! $graficos['gastoDiarioPorPessoa']->script() !!}
    @endif

    @if(isset($graficos['acesso']))
    {!! $graficos['acesso']->script() !!}
    @endif

    @if(isset($graficos['transporteDestino']))
    {!! $graficos['transporteDestino']->script() !!}
    @endif

    @if(isset($graficos['organizacaoViagem']))
    {!! $graficos['organizacaoViagem']->script() !!}
    @endif

    @if(isset($graficos['outrosOrganizadores']))
    {!! $graficos['outrosOrganizadores']->script() !!}
    @endif

    @if(isset($graficos['nota']))
    {!! $graficos['nota']->script() !!}
    @endif

    @endif

    <script>
        function trocarId() {
            const novoId = document.getElementById('idInput').value;
            if (novoId) {
                window.location.href = '/dashboard/' + novoId;
            }
        }

        function navegarPara(secaoId) {
            if (secaoId) {
                const elemento = document.getElementById(secaoId);
                if (elemento) {
                    elemento.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Reset select depois de navegar
                    setTimeout(() => {
                        document.getElementById('navegacaoSelect').value = '';
                    }, 500);
                }
            }
        }

        document.getElementById('idInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                trocarId();
            }
        });

        // Highlight da seção atual baseada no scroll
        window.addEventListener('scroll', function() {
            const sections = ['perfil-visitante', 'origem', 'conhecimento-previo', 'acompanhantes', 'organizacao-viagem', 'motivacao-interesses', 'duracao-viagem', 'transporte', 'gasto-diario', 'satisfacao'];
            let current = '';
            
            sections.forEach(section => {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top <= 100 && rect.bottom >= 100) {
                        current = section;
                    }
                }
            });
        });
    </script>
</body>

</html>