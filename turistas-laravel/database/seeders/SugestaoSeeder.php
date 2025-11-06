<?php

namespace Database\Seeders;

use App\Models\Sugestao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SugestaoSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Cria as 3 sugestoes (Pico, Medio, Baixo)
        $sugestoes = [
            'Pico' => [
                // 40 itens para PICO (grandes fluxos) — foco em gestão de capacidade, infraestrutura, sustentabilidade
                "Implementar sistema de gestão de capacidade (capacidade diária máxima) para pontos turísticos sensíveis",
                "Criar corredores exclusivos de transporte público para aliviar trânsito durante picos",
                "Instalar estações temporárias de primeiros socorros e pontos de assistência em áreas de grande circulação",
                "Lançar programa de recolha e separação de resíduos para visitantes com contentores identificados",
                "Introduzir sistema de reservas online para atrações mais concorridas",
                "Implementar tarifação dinâmica / peak pricing para gerir procura",
                "Aumentar a fiscalização e ordenamento de vendedores informais para reduzir impacto ambiental",
                "Criar centros de informação multilingue (português, inglês, francês) em hubs turísticos",
                "Promover rotas alternativas e turismo disperso para descongestionar pontos centrais",
                "Instalar sinalética acessível e mapas táteis para pessoas com mobilidade reduzida",
                "Parcerias com hotéis para promover estadias mais longas e distribuição de fluxos",
                "Instalar sistemas de monitorização em tempo real (câmeras/contadores) para gerir lotação",
                "Campanhas de educação do visitante sobre conservação e respeito à cultura local",
                "Criar medidas temporárias de controlo de ruído e horário de atividades noturnas",
                "Implementar pontos de carregamento elétrico e incentivos ao uso de veículos sustentáveis",
                "Criar equipes de limpeza reforçadas durante a época de pico e sistemas de incentivos",
                "Programa de contratação temporária local para reforçar serviços (hospitalidade, limpeza)",
                "Criar fundos de compensação comunitária (taxa turística) para projetos ODS locais",
                "Introduzir regras temporárias de estacionamento e shuttle a partir de park & ride",
                "Certificação rápida de alojamentos que adotem práticas sustentáveis",
                "Instalar sanitários públicos adequados e manutenção reforçada",
                "Implementar controles e quotas em trilhos naturais para evitar erosão",
                "Monitorização do consumo de água e medidas de redução em pontos críticos",
                "Planos de emergência e evacuação ajustados para alta afluência",
                "Cartões/avisos digitais com informação sobre recicláveis e pontos de recolha",
                "Programas de promoção de produtos locais para aumentar receita comunitária",
                "Coordenação com autoridades de saúde para aumentar vigilância sanitária",
                "Sinalização eletrónica com lotação atual de atracções",
                "Acordos com operadores turísticos para escalonar visitas durante o dia",
                "Campanhas de sensibilização sobre fauna/flora endémica e restrições",
                "Estabelecer pontos de descanso e sombra para minimizar stress térmico dos visitantes",
                "Incentivar opções de refeição com ingredientes locais e práticas sustentáveis",
                "Criar programas de voluntariado de limpeza pós-eventos",
                "Implementar sistemas de recolha e tratamento de águas residuais temporárias",
                "Oficinas de formação para guias turísticos sobre gestão de grandes grupos",
                "Gestão de filas (digital/QR) e tempo médio de espera para reduzir aglomerações",
                "Implementar sistema de feedback em tempo real para detetar problemas operacionais",
                "Planos de rotação de eventos/feiras para distribuir impacto entre comunidades",
                "Promover seguro obrigatório para operadores que trabalham em períodos de pico",
            ],
            'Medio' => [
                // 40 itens para MEDIO (fluxo moderado) — foco em consolidação e sustentabilidade
                "Programas de capacitação para guias locais sobre interpretação cultural e ambiental",
                "Melhorar sinalética turística e informação em pontos centrais e postos de turismo",
                "Criar rotas temáticas (cultural, ecológico, gastronómico) para diversificar oferta",
                "Programas de apoio a pequenas empresas locais para integrar cadeia de valor turística",
                "Implementar contentores de resíduos seletivos em zonas turísticas",
                "Iniciativas de promoção fora da época para reduzir sazonalidade",
                "Criar eventos culturais que valorizem património e atraiam públicos internacionais",
                "Promover certificações ambientais para alojamentos e operadores",
                "Desenvolver plataformas online de reserva e estatísticas para gestores locais",
                "Criar parcerias com universidades para monitorização e pesquisa turística",
                "Melhorias moderadas na infraestrutura sanitária em pontos turísticos",
                "Campanhas de marketing direcionado para mercados emissores estratégicos",
                "Programas de formação em línguas básicas para recepção de estrangeiros",
                "Incentivar transporte público local e rotas dedicadas a turistas",
                "Promover produtos artesanais e gastronomia local em feiras",
                "Instalar postos de hidratação e pontos de sombra em trilhos e praças",
                "Programas de auditoria energética para estabelecimentos turísticos",
                "Apoiar projetos de turismo comunitário e homestays sustentáveis",
                "Criar directrizes de boas práticas para operadores de turismo local",
                "Melhorar a sinalização de segurança e normas para atividades de risco",
                "Implementar sistema de avaliação de experiência do visitante (NPS)",
                "Capacitar clubes e associações locais para gerir atrações menores",
                "Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade",
                "Projetos de recuperação de espaços urbanos e praças para uso turístico",
                "Programas de sensibilização sobre conservação marinha e costeira",
                "Parcerias com transportadoras para pacotes integrados (bus + atracção)",
                "Melhorar coleta e tratamento de resíduos em mercados e áreas recreativas",
                "Criar roteiros auto-guiados com QR-codes em pontos de interesse",
                "Oferecer formação em atendimento ao cliente e hospitalidade",
                "Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)",
                "Promover experiências autênticas com comunidades locais",
                "Manutenção periódica de trilhos e infraestrutura leve",
                "Parcerias com ONGs para projetos de conservação/empoderamento local",
                "Mapeamento e monitorização de indicadores ODS relevantes",
                "Fomentar cooperação entre municípios para partilha de melhores práticas",
                "Criação de cartões turísticos com descontos em serviços locais",
                "Estimular microcrédito para pequenos empreendedores turísticos",
                "Programa de recolha de dados climáticos locais para melhorar previsões",
            ],
            'Baixo' => [
                // 40 itens para BAIXO (fluxo reduzido) — foco em atrair, desenvolver oferta e promoção sustentável
                "Campanhas de marketing internacional focadas em nichos (ecoturismo, cultural)",
                "Incentivos fiscais para novos investimentos em alojamento sustentável",
                "Programas de capacitação para empreendedores locais em hospitalidade",
                "Desenvolver pacotes promocionais com operadores internacionais",
                "Facilitar processos de vistos/entrada para turistas estrangeiros (parcerias)",
                "Melhorar presença digital (site multilingue e SEO para a província)",
                "Criar itinerários que combinem natureza e cultura para diferenciacao",
                "Organizar fam-trips para operadores e jornalistas estrangeiros",
                "Apoiar pequenas pousadas e guesthouses com microcréditos",
                "Promover festivais culturais anuais para atrair visitantes",
                "Parcerias com companhias aéreas para rotas sazonais",
                "Fomentar produtos locais (artesanato, gastronomia) como atrativo",
                "Investir em sinalética e acessibilidade básica em pontos turísticos",
                "Programas de intercâmbio com universidades para projetos de investigação",
                "Criar incentivos para alojamentos obterem certificações sustentáveis",
                "Melhorar segurança e perceção de segurança para visitantes estrangeiros",
                "Desenvolver experiências de voluntariado sustentável que atraiam viajantes",
                "Pacotes de promoção combinando alojamento, transporte e experiências",
                "Oficinas de storytelling e branding para pequenos operadores locais",
                "Criar programas de turismo comunitário com repartição de receitas",
                "Melhorar conectividade (internet) em locais de interesse turístico",
                "Campanhas de comunicação sobre património cultural e natural",
                "Estabelecer um selo de qualidade para serviços turísticos locais",
                "Incentivar investimentos em energias renováveis para pousadas",
                "Promoção de roteiros seguros para turistas individuais",
                "Apoiar projetos de conservação que possam ser visitáveis (edu-tourism)",
                "Facilitar capacitação linguística básica para recepção de estrangeiros",
                "Promover viagens fora da época com descontos dirigidos",
                "Criar mercados semanais de produtos locais para turistas",
                "Parcerias com operadoras de turismo responsável",
                "Oferecer incentivos para melhoria de infra-estrutura rodoviária local",
                "Programas de microempreendedorismo para guias e condutores locais",
                "Desenvolver conteúdos digitais (vídeos, tours virtuais) sobre a província",
                "Promover experiências gastronómicas locais com rotas culinárias",
                "Programa de bolsas para formação de guias locais especializados",
                "Criar incubadoras de turismo sustentável para negócios locais",
                "Implementar políticas de acolhimento ao turista (pontos de informação)",
                "Criar mecanismos de monitorização de impacto e retorno económico local",
            ],
        ];

        foreach ($sugestoes as $nome => $itens) {
            // inserir sugestao
            $sugestaoId = Sugestao::where('nome',$nome)->first()->id;

            // inserir 40 itens
            foreach ($itens as $descricao) {
                DB::table('item_sugestaos')->insert([
                    'sugestao_id' => $sugestaoId,
                    'descricao' => $descricao,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
