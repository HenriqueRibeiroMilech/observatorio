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
            'estados' => $this->graficoEstados($dados)
        ];
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

    // Gráfico barras: top 10 estados de origem
    private function graficoEstados($dados)
    {
        $estados = [];
        
        // Conta cada estado
        foreach ($dados as $registro) {
            $uf = trim($registro['uf_procedencia'] ?? 'Não informado');
            if (empty($uf)) $uf = 'Não informado';
            $estados[$uf] = ($estados[$uf] ?? 0) + 1;
        }
        
        // Ordena e pega top 10
        arsort($estados);
        $estados = array_slice($estados, 0, 10, true);
        
        $chart = new Chart;
        $chart->labels(array_keys($estados));
        $chart->dataset('Visitantes por Estado', 'bar', array_values($estados))
              ->backgroundColor('#9966FF');
        
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
