# 🇦🇴 Angola Tourism Insight

## 📘 Visão Geral
O **Angola Tourism Insight** é um projeto de análise e previsão de dados turísticos de Angola.  
Esta fase — **Preparação dos Dados e Engenharia de Recursos** — visa consolidar e transformar dados brutos em conjuntos limpos e prontos para análise e modelagem.

Basicamente começamos a tratablhar na  parte pratica do projeto e ainda está em desenvolvimento, resolvemos fazer o projeto web, ou seja teremos um modelo de machine learn em python que será capaz de prever o numero de turistas estrangeiros seguindo determinados parametros, então o projeto web está sendo desenvolvido utilizando o fremework laravel, estamos desenvolvendo o sistema de autenticação e alguns detalhes importantes

---

Descrição Documental da Plataforma “Angola Tourism Insight”
1. Introdução
A Angola Tourism Insight é uma plataforma digital desenvolvida com o propósito de reunir, analisar e disponibilizar informações sobre o turismo em Angola, fornecendo previsões e indicadores que auxiliam na tomada de decisão estratégica e na promoção do desenvolvimento sustentável do setor.
O sistema foi concebido para integrar dados climáticos, ambientais e sociais, associando-os ao número de visitantes registados em diferentes localidades do país. A partir dessa base de dados, o sistema realiza previsões de fluxo turístico e gera sugestões de intensidade turística (pico, médio ou baixo), permitindo um melhor planeamento de políticas públicas e de iniciativas privadas ligadas ao turismo.
2. Objetivo da Plataforma
O principal objetivo da plataforma é apoiar o desenvolvimento sustentável do turismo angolano através da digitalização, análise e previsão de dados turísticos.
Para além disso, o sistema serve como um repositório institucional, onde são armazenados e publicados documentos e relatórios oficiais relacionados ao setor do turismo e ambiente, como estudos, políticas, pautas e relatórios de campo.
3. Estrutura Geral do Sistema
A plataforma está organizada em duas áreas principais:
1.	Área Pública:
Disponível a todos os visitantes, onde é possível visualizar informações gerais sobre o turismo, previsões e relatórios públicos.
2.	Área Administrativa:
Acesso restrito a utilizadores autenticados (administradores, técnicos e analistas), onde são realizados o carregamento de dados, gestão de arquivos, análise estatística e publicação de relatórios.
4. Funcionalidades Principais
4.1. Previsão de Turistas
Esta é a funcionalidade central do sistema.
Com base em dados históricos de turistas estrangeiros (ano, mês, localidade, temperatura, precipitação e número de visitantes), o sistema aplica modelos de previsão para estimar o número provável de turistas em determinada localidade e período.
Essas previsões são acompanhadas de indicadores visuais e analíticos, que ajudam a interpretar o nível de fluxo turístico esperado:
•	Pico Turístico: quando o número previsto de visitantes está acima da média máxima histórica da localidade;
•	Médio: quando o valor previsto está entre a média mínima e a média máxima;
•	Baixo: quando o número de visitantes está abaixo da média mínima histórica.
Esses padrões foram definidos com base na análise estatística das médias históricas de turistas por província, permitindo estabelecer intervalos de referência próprios para cada região.
A funcionalidade permite ainda gerar gráficos comparativos entre períodos, acompanhar a evolução do turismo e identificar tendências sazonais.
4.2. Sugestões Automáticas
Com base nas previsões e nos padrões de fluxo turístico, o sistema gera sugestões automáticas que orientam os utilizadores sobre a situação turística esperada:
•	Sugestão de Pico: indica elevado potencial turístico, ideal para intensificar ações de marketing e eventos culturais;
•	Sugestão Média: indica estabilidade, sendo propício para manutenção de serviços e monitorização contínua;
•	Sugestão Baixa: indica retração turística, recomendando estratégias de promoção, revisão de preços ou estímulo de atividades locais.
Estas sugestões também são relacionadas aos Objetivos de Desenvolvimento Sustentável (ODS), destacando como o turismo sustentável pode contribuir para:
•	ODS 8 – Trabalho decente e crescimento económico;
•	ODS 11 – Cidades e comunidades sustentáveis;
•	ODS 13 – Ação contra a mudança global do clima.
4.3. Gestão de Arquivos e Publicações
A plataforma inclui um módulo para gestão e publicação de documentos oficiais e técnicos.
Os arquivos podem ser:
•	Relatórios turísticos;
•	Estudos ambientais;
•	Dados estatísticos;
•	Atas, pautas e outros documentos de interesse público.
O processo segue um fluxo de validação e aprovação:
1.	Envio: o utilizador (prestador ou técnico) carrega o arquivo no sistema, preenchendo título, descrição, categoria e metadados.
2.	Validação: o administrador analisa o conteúdo e decide se o documento será:
o	Aprovado: publicado e disponível ao público;
o	Pendente: aguardando revisão ou complementação;
o	Arquivado: guardado para consulta interna, mas não exibido publicamente.
3.	Publicação: os arquivos aprovados são listados na área pública da plataforma e podem ser visualizados ou descarregados conforme o tipo de ficheiro.
A plataforma reconhece automaticamente diferentes tipos de arquivos (PDF, imagens, planilhas, textos, etc.), permitindo pré-visualização e download.
4.4. Histórico e Metadados
Cada arquivo e previsão armazenam informações complementares, como:
•	Data de criação e atualização;
•	Nome do utilizador que realizou o upload;
•	Tipo de arquivo e tamanho;
•	Estado de aprovação (pendente, aprovado, arquivado).
Esses dados garantem rastreabilidade e transparência, além de permitir auditorias e histórico das alterações realizadas.
5. Tipos de Utilizadores e Permissões
A plataforma organiza o acesso e as responsabilidades através de três tipos principais de utilizadores, descritos a seguir. Cada tipo tem um conjunto específico de permissões que reflete o seu papel operativo na gestão das previsões, dos dados e dos ficheiros.
5.1 Administrador
O Administrador é o utilizador com maior nível de privilégios e é responsável pela administração global da plataforma. Principais responsabilidades e permissões:
•	Gerir todos os registos do sistema (utilizadores, províncias, sugestões, itens de sugestão, históricos, etc.).
•	Aprovar, arquivar ou manter pendentes os ficheiros submetidos pelos prestadores; definir políticas de publicação.
•	Definir e gerir papéis/permissões (atribuir ou revogar a função de Gestor, Administrador, Prestador).
•	Aceder a todos os relatórios e históricos; executar ações administrativas sobre previsões quando necessário.
•	Configurar parâmetros globais do sistema (limiares de classificação, definições de seeders, políticas de upload e quotas).
Resumindo: o Administrador governa a plataforma e toma decisões finais sobre publicação e configuração.
5.2 Gestor (provincial)
O Gestor é responsável por conduzir a atividade operacional da plataforma no nível da província. Importante notar que uma província pode ter vários Gestores atribuídos — isto permite coordenação entre técnicos locais e cobertura por diferentes turnos/equipa.
Permissões e responsabilidades principais do Gestor:
•	Criar e submeter previsões para a(s) localidade(s) da sua província, utilizando o formulário com parâmetros climáticos e de contexto.
•	Aceder ao histórico de previsões da sua província (registos guardados em historicos), incluindo todas as entradas feitas por si e por outros gestores da mesma província.
•	Consultar as sugestões previamente geradas (Pico / Médio / Baixo) e os itens de sugestão associados às previsões da sua província.
•	Utilizar os resultados e as sugestões para produzir recomendações locais ou relatórios para os decisores provinciais.
•	Não tem permissão para aprovar/arquivar ficheiros submetidos por prestadores — essa função é exclusiva do Administrador.
•	Pode, conforme política da instituição, solicitar revisão de ficheiros ou adicionar comentários às previsões/históricos.
Resumindo: o Gestor operacionaliza as previsões e utiliza o histórico e as sugestões para planear ações provinciais.
5.3 Prestador
O Prestador é o utilizador responsável por submeter conjuntos de dados e documentos (ficheiros) ao repositório da plataforma. Este papel privilegia a contribuição de dados por entidades externas ou internas.
Permissões e responsabilidades principais do Prestador:
•	Submeter ficheiros (CSV, Excel, PDF, DOCX, imagens, etc.) com titulo, descricao, tags e metadados.
•	Gerir apenas os seus próprios ficheiros: editar metadados, substituir conteúdo enquanto o ficheiro estiver em estado pendente ou consoante as regras definidas.
•	Visualizar o estado dos seus ficheiros (pendente, aprovado, arquivado) e receber notificações sobre mudanças de estado.
•	Não tem permissão para aprovar, arquivar ou publicar ficheiros de outros prestadores; essa ação cabe ao Administrador.
•	Pode apagar os seus ficheiros se as regras internas o permitirem (por exemplo, se estiverem ainda pendentes); uma vez aprovados e publicados, a remoção pode exigir ação administrativa.
Resumindo: o Prestador contribui com dados e gerencia os seus próprios uploads; não controla aprovação ou publicação final.
Observações Operacionais
•	Rastreamento e responsabilidade: cada ação relevante (criação de previsão, submissão de ficheiro, aprovação, arquivamento) fica registada para fins de auditoria e rastreabilidade, com indicação do user_id e timestamp.
•	Multiplicidade de gestores: a possibilidade de ter vários gestores por província permite redundância operacional e partilha de responsabilidades entre equipa provincial.
•	Políticas de acesso: as permissões devem ser implementadas com Policies/Gates no backend para garantir que cada rota ou ação verifica o papel do utilizador antes de executar operações sensíveis.
6. Relação com os Objetivos de Desenvolvimento Sustentável (ODS)
O Angola Tourism Insight contribui diretamente para várias metas dos ODS:
ODS	Objetivo	Relação com a Plataforma
ODS 8	Promover o crescimento económico sustentado, inclusivo e sustentável	Através da análise e previsão do fluxo turístico, incentiva a criação de políticas que valorizem o emprego e o empreendedorismo local.
ODS 11	Tornar as cidades e comunidades mais sustentáveis	Facilita o planeamento urbano e turístico responsável, reduzindo pressões sazonais e promovendo equilíbrio regional.
ODS 13	Ação climática	Integra dados meteorológicos (temperatura e precipitação) para alinhar o turismo às condições ambientais e à resiliência climática.

7. Considerações Finais
A Angola Tourism Insight representa um passo significativo rumo à digitalização e modernização da gestão turística nacional.
Ao unir dados estatísticos, previsão inteligente e gestão documental, a plataforma oferece uma visão clara e integrada do panorama turístico angolano.
Além de promover transparência e acessibilidade à informação, o sistema reforça o compromisso com o desenvolvimento sustentável, apoiando decisões baseadas em dados e contribuindo para a valorização das potencialidades turísticas de Angola.



