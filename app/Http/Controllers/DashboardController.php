<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardController extends Controller
{
    // Exibe o dashboard com gráficos
    public function show($id)
    {
        try {
            // Consulta a API
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://www.observatorioserragaucha.tur.br/api/identidade/get-registros', [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => ['id_identidade_pesquisa' => intval($id)]
            ]);
            
            $dados = json_decode($response->getBody(), true);
            
            if (empty($dados)) {
                return view('dashboard', ['erro' => 'Nenhum dado encontrado para o ID: ' . $id, 'id' => $id]);
            }
            
            // Gera os gráficos
            $graficos = $this->criarGraficos($dados);
            
            return view('dashboard', compact('id', 'graficos', 'dados'));
            
        } catch (\Exception $e) {
            return view('dashboard', ['erro' => 'Erro ao consultar API: ' . $e->getMessage(), 'id' => $id]);
        }
    }
    
    // Cria todos os gráficos
    private function criarGraficos($dados)
    {
        return [
            'genero' => $this->graficoGenero($dados),
            'faixaEtaria' => $this->graficoFaixaEtaria($dados),
            'formacaoEscolar' => $this->graficoFormacaoEscolar($dados),
            'rendaPessoal' => $this->graficoRendaPessoal($dados),
            'profissoes' => $this->graficobarra(dados:$dados,chave:'profissao',titulo:'Contagem de Profissões', valorNulo : 'NÃO CADASTRADA'),

            'estadosBarra' => $this->graficobarra(dados:$dados,chave:'uf_procedencia',titulo:'Visitantes por Estado', naoinformado:True),
            'estadosPizza' => $this->graficoEstadoPizza($dados),
            'paisPizza' => $this->graficoPaisPizza($dados),
            'paisBarra' => $this->graficobarra(dados:$dados,chave:'pais_procedencia',titulo:'Visitantes por País', naoinformado:True),
            'municipios' => $this->graficobarra(dados:$dados,chave:'municipio_procedencia',titulo:'Visitantes por Município', naoinformado:True),

            'perfilViajantes' => $this->graficoPerfilViajantes($dados),
            'quantidadeViajantes' => $this->graficoQuantidadeViajantes($dados),

            'conhecimentoPrevio' => $this->graficoConhecimentoPrevio($dados),
            'fontesReferencia' => $this->graficobarra(dados:$dados,chave:'fontes_informacao', separador:','),

            'interesses' => $this->graficobarra(dados:$dados,chave:'interesse', separador:',', naoinformado:True),

            'acesso' => $this->graficobarra(dados:$dados,chave:'transporte_acessos', separador:',', naoinformado:True),
            'transporteDestino' => $this->graficobarra(dados:$dados,chave:'transporte_destinos', separador:',', naoinformado:True),

            'nota' => $this->graficobarra(dados:$dados,chave:'nota_geral', naoinformado:True) #MUDAR PARA PEGAR EM ORDEM E NÃO PEGAR OS NÃO INFORMADO
        ];
    }

    private function graficobarra($dados, $chave, $titulo = '', $cor = ['#9966FF'], $valorNulo = 'Não informado', $separador = null, $limite = 15, $naoinformado = False){
        $contagem = [];

        foreach ($dados as $registro) {
            $valorBruto = $registro[$chave] ?? $valorNulo;

            if ($naoinformado && (is_null($valorBruto) || trim($valorBruto) === '')) {
                continue;
            }

            if (empty($valorBruto)) {
                $contagem[$valorNulo] = ($contagem[$valorNulo] ?? 0) + 1;
                continue;
            }

            $valores = $separador ? explode($separador, $valorBruto) : [$valorBruto];

            foreach ($valores as $item) {
                $item = trim($item);
                if ($item === '') $item = $valorNulo;
                $contagem[$item] = ($contagem[$item] ?? 0) + 1;
            }
        }

        arsort($contagem);
        $contagem = array_slice($contagem, 0, $limite, true);

        $chart = new Chart;
        $chart->labels(array_keys($contagem));
        $chart->dataset($titulo, 'bar', array_values($contagem))
            ->backgroundColor($cor);

        return $chart;
    }

    // Gráfico pizza: distribuição por gênero
    private function graficoGenero($dados)
    {
        $masculino = 0;
        $feminino = 0;
        
        // Conta M e F nos dados
        foreach ($dados as $registro) {
            if (($registro['genero'] ?? '') === 'M') $masculino++;
            elseif (($registro['genero'] ?? '') === 'F') $feminino++;
        }
        
        $chart = new Chart;
        $chart->labels(['Masculino', 'Feminino']);
        $chart->dataset('Distribuição por Gênero', 'pie', [$masculino, $feminino])
              ->backgroundColor(['#36A2EB', '#FF6384']);
        
        return $chart;
    }

    // Gráfico pizza: Faixa Etária
    private function graficoFaixaEtaria($dados)
    {
        $grupo1 = 0; // 20-29
        $grupo2 = 0; // 30-39
        $grupo3 = 0; // 40-49
        $grupo4 = 0; // 50-59
        $grupo5 = 0; // 60-69
        $grupo6 = 0; // 70-79
        $outros = 0; // <20 ou >79
        
        // Agrupa as idades
        foreach ($dados as $registro) {
            $idade = intval($registro['idade'] ?? 0);

            if ($idade >= 20 && $idade <= 29) {
                $grupo1++;
            } elseif ($idade >= 30 && $idade <= 39) {
                $grupo2++;
            } elseif ($idade >= 40 && $idade <= 49) {
                $grupo3++;
            } elseif ($idade >= 50 && $idade <= 59) {
                $grupo4++;
            } elseif ($idade >= 60 && $idade <= 69) {
                $grupo5++;
            } elseif ($idade >= 70 && $idade <= 79) {
                $grupo6++;
            } else {
                $outros++;
            }
        }
        
        $chart = new Chart;
        $chart->labels(['20-29', '30-39', '40-49', '50-59', '60-69', '70-79', 'Outros']);
        $chart->dataset('Distribuição por Faixa Etária', 'pie', [$grupo1, $grupo2, $grupo3, $grupo4, $grupo5, $grupo6, $outros])
              ->backgroundColor(["#440154","#443983","#31688e","#21918c","#35b779","#90d743","#fde725"]);
        
        return $chart;
    }

    // Gráfico pizza: Nível de Formação Escolar
    private function graficoFormacaoEscolar($dados)
    {
        $ensinoFundamental = 0; 
        $ensinoMedio = 0; 
        $graduacao = 0;
        $especializacao = 0;
        $mestrado = 0;
        $doutorado = 0;
        $semInstrucao = 0; 
        $naoInformado = 0;
        
        foreach ($dados as $registro) {
            $formacao = strtolower(trim($registro['formacao_escolar'] ?? ''));

            if (str_contains($formacao, 'fundamental')) {
                $ensinoFundamental++;
            } elseif (str_contains($formacao, 'médio')) {
                $ensinoMedio++;
            } elseif (str_contains($formacao, 'graduação')) {
                $graduacao++;
            } elseif (str_contains($formacao, 'especialização')) {
                $especializacao++;
            } elseif (str_contains($formacao, 'mestrado')) {
                $mestrado++;
            } elseif (str_contains($formacao, 'doutorado')) {
                $doutorado++;
            } elseif (str_contains($formacao, 'sem instrução')) {
                $semInstrucao++;
            }  else {
                $naoInformado++;
            }
        }
        
        $chart = new Chart;
            $chart->labels(['Ensino Fundamental', 'Ensino Médio', 'Graduação', 'Especialização', 'Mestrado', 'Doutorado', 'Sem Instrução', 'Não Informado']);
        $chart->dataset('Distribuição por Faixa Etária', 'pie', [$ensinoFundamental, $ensinoMedio, $graduacao, $especializacao, $mestrado, $doutorado, $semInstrucao, $naoInformado])
              ->backgroundColor(["#440154","#46327e","#365c8d","#277f8e","#1fa187","#4ac16d","#a0da39","#fde725"]);
        
        return $chart;
    }

    // Gráfico pizza: Nível de Renda Pessoal
    private function graficoRendaPessoal($dados)
    {
        $semInformacao = 0; 
        $menosMil = 0; 
        $milDois = 0;
        $doisTres = 0;
        $tresCinco = 0;
        $cincoSete = 0;
        $seteDez = 0;
        $dezQuinze = 0;
        $quinzeVinte = 0;
        $vinteTrinta = 0;
        $trintaCinquenta = 0;
        $maisCinquenta = 0;
        
        foreach ($dados as $registro) {
            $renda = intval($registro['renda_mensal'] ?? 0);

            if ($renda < 0) {
                $semInformacao++;
            } elseif ($renda < 1) {
                $menosMil++;
            } elseif ($renda < 2) {
                $milDois++;
            } elseif ($renda < 3) {
                $doisTres++;
            } elseif ($renda < 5) {
                $tresCinco++;
            } elseif ($renda < 7) {
                $cincoSete++;
            } elseif ($renda < 10) {
                $seteDez++;
            } elseif ($renda < 15) {
                $dezQuinze++;
            } elseif ($renda < 20) {
                $quinzeVinte++;
            } elseif ($renda < 30) {
                $vinteTrinta++;
            } elseif ($renda < 50) {
                $trintaCinquenta++;
            } else {
                $maisCinquenta++;
            }
        }
        
        $chart = new Chart;
            $chart->labels([
                'Sem informação',
                'Até R$ 1 mil',
                'R$ 1–2 mil',
                'R$ 2–3 mil',
                'R$ 3–5 mil',
                'R$ 5–7 mil',
                'R$ 7–10 mil',
                'R$ 10–15 mil',
                'R$ 15–20 mil',
                'R$ 20–30 mil',
                'R$ 30–50 mil',
                'Acima de R$ 50 mil'
            ]);
        $chart->dataset('Distribuição por Faixa Etária', 'pie', [
            $semInformacao,
            $menosMil,
            $milDois,
            $doisTres,
            $tresCinco,
            $cincoSete,
            $seteDez,
            $dezQuinze,
            $quinzeVinte,
            $vinteTrinta,
            $trintaCinquenta,
            $maisCinquenta
        ])
              ->backgroundColor(["#440154","#482173","#433e85","#38588c","#2d708e","#25858e","#1e9b8a","#2ab07f","#52c569","#86d549","#c2df23","#fde725"]);
        
        return $chart;
    }

    // Gráfico pizza: Rio Grande do Sul || Outros estados
    private function graficoEstadoPizza($dados)
    {
        $rs = 0; 
        $outro = 0;

        
        foreach ($dados as $registro) {
            $uf = strtoupper(trim($registro['uf_procedencia'] ?? ''));

            if (str_contains($uf, 'RIO GRANDE DO SUL')){
                $rs++;
            } else{
                $outro++;
            }
        }
        
        $chart = new Chart;
        $chart->labels(['Rio Grande do Sul', 'Outros estados']);
        $chart->dataset('Estado de Origem', 'pie', [$rs, $outro])
              ->backgroundColor(["#5ec962","#482173"]);

        return $chart;
    }

    // Gráfico pizza: Brasil || Outros países
    private function graficoPaisPizza($dados)
    {
        $brasil = 0; 
        $outro = 0;

        
        foreach ($dados as $registro) {
            $pais = strtoupper(trim($registro['pais_procedencia'] ?? ''));

            if (str_contains($pais, 'BRASIL')){
                $brasil++;
            } else{
                $outro++;
            }
        }
        
        $chart = new Chart;
            $chart->labels(['Brasil', 'Outros países']);
        $chart->dataset('Distribuição por Faixa Etária', 'pie', [$brasil, $outro])
              ->backgroundColor(["#5ec962","#482173"]);

        return $chart;
    }

    // Gráfico barras: top 15 Munícipios de residência
    private function graficoMunicipios($dados)
    {
        $municipios = [];
        
        // Conta cada estado
        foreach ($dados as $registro) {
            $municipio = trim($registro['municipio_procedencia'] ?? 'Não informado');
            if (empty($municipio)) $municipio = 'Não informado';
            $municipios[$municipio] = ($municipios[$municipio] ?? 0) + 1;
        }
        
        // Ordena e pega top 15
        arsort($municipios);
        $municipios = array_slice($municipios, 0, 15, true);
        
        $chart = new Chart;
        $chart->labels(array_keys($municipios));
        $chart->dataset('Visitantes por Município', 'bar', array_values($municipios))
              ->backgroundColor('#9966FF');
        
        return $chart;
    }

    // Gráfico pizza: Conhecimento prévio do destino (Sim/Não)
    private function graficoConhecimentoPrevio($dados)
    {
        $sim = 0; 
        $nao = 0;

        foreach ($dados as $registro) {
            if (($registro['conhece_destino'] ?? null) == 1) {
                $sim++;
            } else {
                $nao++;
            }
        }
        
        $chart = new Chart;
            $chart->labels(['Sim', 'Não']);
        $chart->dataset('Conhecimento Prévio do Destino', 'pie', [$sim, $nao])
              ->backgroundColor(["#00ff00","#ff0000"]);

        return $chart;
    }

    // Gráfico de Pizza: perfil dos viajantes
    private function graficoPerfilViajantes($dados)
    {
        $perfis = [];
        
        // Conta cada estado
        foreach ($dados as $registro) {
            $perfil = trim($registro['acompanhantes'] ?? 'Não informado');
            if (empty($perfil)) $perfil = 'Não informado';
            $perfis[$perfil] = ($perfis[$perfil] ?? 0) + 1;
        }
        
        arsort($perfis);
        
        $chart = new Chart;
        $chart->labels(array_keys($perfis));
        $chart->dataset('Perfil dos Viajantes', 'pie', array_values($perfis))
              ->backgroundColor(["#440154","#482878","#3e4989","#31688e","#26828e","#1f9e89","#35b779","#6ece58","#b5de2b","#fde725"]);
        
        return $chart;
    }

    // Gráfico pizza: Quantidade de pessoas na viagem
    private function graficoQuantidadeViajantes($dados)
    {
        $um = 0; 
        $dois = 0; 
        $tresQuatro = 0;
        $cincoDez = 0;
        $onzeVinte = 0;
        $maisVinte = 0;
        
        foreach ($dados as $registro) {
            $qtd = intval($registro['total_pessoas_viajando'] ?? 0);

            if ($qtd < 2) {
                $um++;
            } elseif ($qtd < 3) {
                $dois++;
            } elseif ($qtd < 5) {
                $tresQuatro++;
            } elseif ($qtd < 11) {
                $cincoDez++;
            } elseif ($qtd < 21) {
                $onzeVinte++;
            } else {
                $maisVinte++;
            }
        }
        
        $chart = new Chart;
            $chart->labels([
                '1',
                '2',
                '3-4',
                '5-10',
                '11-20',
                '20+'
            ]);
        $chart->dataset('Distribuição por Quantidade de pessoas', 'pie', [
            $um,
            $dois,
            $tresQuatro,
            $cincoDez,
            $onzeVinte,
            $maisVinte
        ])
              ->backgroundColor(["#440154","#414487","#2a788e","#22a884","#7ad151","#fde725"]);
        
        return $chart;
    }












    // Retorna dados da API em JSON para debug
    public function verDados($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://www.observatorioserragaucha.tur.br/api/identidade/get-registros', [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => ['id_identidade_pesquisa' => intval($id)]
            ]);
            
            $dados = json_decode($response->getBody(), true);
            
            return response()->json([
                'id_pesquisado' => $id,
                'total_registros' => count($dados),
                'dados' => $dados
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao consultar API: ' . $e->getMessage(),
                'id_pesquisado' => $id
            ], 500, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
}
