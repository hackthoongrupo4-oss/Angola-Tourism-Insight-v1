-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para turistas3
CREATE DATABASE IF NOT EXISTS `turistas3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `turistas3`;

-- Copiando estrutura para tabela turistas3.arquivos
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prestador_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `arquivo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint DEFAULT NULL,
  `status` enum('pendente','aprovado','arquivado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `aprovado_em` timestamp NULL DEFAULT NULL,
  `aprovado_por` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arquivos_prestador_id_foreign` (`prestador_id`),
  KEY `arquivos_aprovado_por_foreign` (`aprovado_por`),
  CONSTRAINT `arquivos_aprovado_por_foreign` FOREIGN KEY (`aprovado_por`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `arquivos_prestador_id_foreign` FOREIGN KEY (`prestador_id`) REFERENCES `prestadors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.arquivos: ~4 rows (aproximadamente)
REPLACE INTO `arquivos` (`id`, `prestador_id`, `titulo`, `descricao`, `arquivo_path`, `mime`, `size`, `status`, `aprovado_em`, `aprovado_por`, `created_at`, `updated_at`) VALUES
	(4, 4, 'Turismo Sustentavel 3', 'sdhhhssssssssssssssssssssssssssssss', 'arquivos/turismo-sustentavel-2-1762880079.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 28991, 'aprovado', NULL, NULL, '2025-11-11 16:54:41', '2025-11-11 16:58:21'),
	(5, 5, 'Noovo', 'sdvsfvsfgsfgsfsgsgsfgs', 'arquivos/turismo-sustentavel-1-1762898813.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 28991, 'aprovado', NULL, NULL, '2025-11-11 22:06:54', '2025-11-11 22:09:06'),
	(7, 6, 'Históricos de passageiros', 'jdhfhkmmmmmmmmmmmmmmmmmddd', 'arquivos/final-group-capestone-1763053447.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 19244, 'aprovado', NULL, NULL, '2025-11-13 17:04:07', '2025-11-13 17:04:43'),
	(8, 7, 'Históricos de passageiros 4', 'dvfgfbfdfdgf', 'arquivos/turismo-sustentavel-3-5-1763061696.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 28991, 'aprovado', NULL, NULL, '2025-11-13 19:21:37', '2025-11-13 19:22:56');

-- Copiando estrutura para tabela turistas3.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.gestores
CREATE TABLE IF NOT EXISTS `gestores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provincia_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gestores_user_id_unique` (`user_id`),
  KEY `gestores_provincia_id_foreign` (`provincia_id`),
  CONSTRAINT `gestores_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `gestores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.gestores: ~4 rows (aproximadamente)
REPLACE INTO `gestores` (`id`, `user_id`, `provincia_id`, `created_at`, `updated_at`) VALUES
	(4, 8, 1, '2025-11-11 16:31:40', '2025-11-11 16:31:40'),
	(5, 9, 2, '2025-11-11 16:33:05', '2025-11-11 16:33:05'),
	(6, 10, 3, '2025-11-11 16:33:37', '2025-11-11 16:33:37'),
	(7, 11, 1, '2025-11-11 16:40:46', '2025-11-11 16:40:46');

-- Copiando estrutura para tabela turistas3.historicos
CREATE TABLE IF NOT EXISTS `historicos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `n_turistas` int NOT NULL,
  `data` json NOT NULL,
  `nome_sugestao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipos_sugestoes` json NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `provincia_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historicos_user_id_foreign` (`user_id`),
  KEY `historicos_provincia_id_foreign` (`provincia_id`),
  CONSTRAINT `historicos_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE SET NULL,
  CONSTRAINT `historicos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.historicos: ~16 rows (aproximadamente)
REPLACE INTO `historicos` (`id`, `n_turistas`, `data`, `nome_sugestao`, `tipos_sugestoes`, `user_id`, `provincia_id`, `created_at`, `updated_at`) VALUES
	(37, 3077, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "2", "temp_minima": "2", "precipitacao": "2", "temperatura_media": "3", "temp_maxima_historica": "2", "temp_minima_historica": "2", "temperatura_media_historica": "2", "precipitacao_media_historica": "3"}', 'Medio', '["Promover certificações ambientais para alojamentos e operadores", "Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)", "Criar rotas temáticas (cultural, ecológico, gastronómico) para diversificar oferta", "Incentivar transporte público local e rotas dedicadas a turistas", "Melhorar sinalética turística e informação em pontos centrais e postos de turismo", "Instalar postos de hidratação e pontos de sombra em trilhos e praças", "Criar directrizes de boas práticas para operadores de turismo local", "Capacitar clubes e associações locais para gerir atrações menores", "Iniciativas de promoção fora da época para reduzir sazonalidade", "Melhorias moderadas na infraestrutura sanitária em pontos turísticos"]', 8, 1, '2025-11-11 16:47:00', '2025-11-11 16:47:00'),
	(38, 3077, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "2", "temp_minima": "2", "precipitacao": "2", "temperatura_media": "3", "temp_maxima_historica": "2", "temp_minima_historica": "2", "temperatura_media_historica": "2", "precipitacao_media_historica": "3"}', 'Medio', '["Programas de formação em línguas básicas para recepção de estrangeiros", "Promover certificações ambientais para alojamentos e operadores", "Criar eventos culturais que valorizem património e atraiam públicos internacionais", "Projetos de recuperação de espaços urbanos e praças para uso turístico", "Desenvolver plataformas online de reserva e estatísticas para gestores locais", "Manutenção periódica de trilhos e infraestrutura leve", "Implementar sistema de avaliação de experiência do visitante (NPS)", "Campanhas de marketing direcionado para mercados emissores estratégicos", "Implementar contentores de resíduos seletivos em zonas turísticas", "Criar parcerias com universidades para monitorização e pesquisa turística"]', 8, 1, '2025-11-11 16:47:18', '2025-11-11 16:47:18'),
	(39, 3701, '{"ano": "2024", "mes": "9", "feriado": "0", "temp_maxima": "22", "temp_minima": "2", "precipitacao": "3", "temperatura_media": "2", "temp_maxima_historica": "2", "temp_minima_historica": "2", "temperatura_media_historica": "2", "precipitacao_media_historica": "2"}', 'Medio', '["Melhorias moderadas na infraestrutura sanitária em pontos turísticos", "Promover experiências autênticas com comunidades locais", "Campanhas de marketing direcionado para mercados emissores estratégicos", "Apoiar projetos de turismo comunitário e homestays sustentáveis", "Mapeamento e monitorização de indicadores ODS relevantes", "Capacitar clubes e associações locais para gerir atrações menores", "Criar eventos culturais que valorizem património e atraiam públicos internacionais", "Promover certificações ambientais para alojamentos e operadores", "Estimular microcrédito para pequenos empreendedores turísticos", "Promover produtos artesanais e gastronomia local em feiras"]', 8, 1, '2025-11-11 16:52:33', '2025-11-11 16:52:33'),
	(40, 3283, '{"ano": "2025", "mes": "8", "feriado": "0", "temp_maxima": "7", "temp_minima": "7", "precipitacao": "8.9", "temperatura_media": "5", "temp_maxima_historica": "4", "temp_minima_historica": "8", "temperatura_media_historica": "6", "precipitacao_media_historica": "7.56"}', 'Medio', '["Criar roteiros auto-guiados com QR-codes em pontos de interesse", "Melhorar a sinalização de segurança e normas para atividades de risco", "Mapeamento e monitorização de indicadores ODS relevantes", "Manutenção periódica de trilhos e infraestrutura leve", "Criação de cartões turísticos com descontos em serviços locais", "Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade", "Programas de formação em línguas básicas para recepção de estrangeiros", "Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)", "Incentivar transporte público local e rotas dedicadas a turistas", "Oferecer formação em atendimento ao cliente e hospitalidade"]', 8, 1, '2025-11-11 21:59:36', '2025-11-11 21:59:36'),
	(41, 2616, '{"ano": "2025", "mes": "2", "feriado": "0", "temp_maxima": "8", "temp_minima": "3", "precipitacao": "8", "temperatura_media": "6", "localidade_Benguela": "1", "temp_maxima_historica": "2", "temp_minima_historica": "6", "temperatura_media_historica": "8", "precipitacao_media_historica": "4"}', 'Medio', '["Criar eventos culturais que valorizem património e atraiam públicos internacionais", "Instalar postos de hidratação e pontos de sombra em trilhos e praças", "Manutenção periódica de trilhos e infraestrutura leve", "Parcerias com ONGs para projetos de conservação/empoderamento local", "Promover produtos artesanais e gastronomia local em feiras", "Iniciativas de promoção fora da época para reduzir sazonalidade", "Incentivar transporte público local e rotas dedicadas a turistas", "Criar roteiros auto-guiados com QR-codes em pontos de interesse", "Programas de sensibilização sobre conservação marinha e costeira", "Melhorar coleta e tratamento de resíduos em mercados e áreas recreativas"]', 1, NULL, '2025-11-11 22:03:06', '2025-11-11 22:03:06'),
	(42, 3077, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "1", "temp_minima": "2", "precipitacao": "2", "temperatura_media": "2", "temp_maxima_historica": "3", "temp_minima_historica": "4", "temperatura_media_historica": "3", "precipitacao_media_historica": "3"}', 'Medio', '["Melhorar a sinalização de segurança e normas para atividades de risco", "Programa de recolha de dados climáticos locais para melhorar previsões", "Promover produtos artesanais e gastronomia local em feiras", "Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)", "Criar directrizes de boas práticas para operadores de turismo local", "Criar rotas temáticas (cultural, ecológico, gastronómico) para diversificar oferta", "Apoiar projetos de turismo comunitário e homestays sustentáveis", "Melhorar sinalética turística e informação em pontos centrais e postos de turismo", "Programas de apoio a pequenas empresas locais para integrar cadeia de valor turística", "Criação de cartões turísticos com descontos em serviços locais"]', 8, 1, '2025-11-13 00:12:39', '2025-11-13 00:12:39'),
	(43, 2930, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "3", "temp_minima": "2", "precipitacao": "2", "localidade_Luanda": "1", "temperatura_media": "4", "temp_maxima_historica": "2", "temp_minima_historica": "3", "temperatura_media_historica": "4", "precipitacao_media_historica": "3"}', 'Medio', '["Apoiar projetos de turismo comunitário e homestays sustentáveis", "Parcerias com ONGs para projetos de conservação/empoderamento local", "Criação de cartões turísticos com descontos em serviços locais", "Capacitar clubes e associações locais para gerir atrações menores", "Criar parcerias com universidades para monitorização e pesquisa turística", "Programas de sensibilização sobre conservação marinha e costeira", "Fomentar cooperação entre municípios para partilha de melhores práticas", "Programa de recolha de dados climáticos locais para melhorar previsões", "Promover certificações ambientais para alojamentos e operadores", "Iniciativas de promoção fora da época para reduzir sazonalidade"]', 1, NULL, '2025-11-13 00:20:30', '2025-11-13 00:20:30'),
	(44, 2875, '{"ano": "2025", "mes": "2", "feriado": "1", "temp_maxima": "100", "temp_minima": "100", "precipitacao": "100", "localidade_Luanda": "1", "temperatura_media": "100", "temp_maxima_historica": "102", "temp_minima_historica": "389", "temperatura_media_historica": "100", "precipitacao_media_historica": "100"}', 'Medio', '["Parcerias com transportadoras para pacotes integrados (bus + atracção)", "Programas de capacitação para guias locais sobre interpretação cultural e ambiental", "Programas de auditoria energética para estabelecimentos turísticos", "Fomentar cooperação entre municípios para partilha de melhores práticas", "Implementar sistema de avaliação de experiência do visitante (NPS)", "Criar rotas temáticas (cultural, ecológico, gastronómico) para diversificar oferta", "Programa de recolha de dados climáticos locais para melhorar previsões", "Apoiar projetos de turismo comunitário e homestays sustentáveis", "Manutenção periódica de trilhos e infraestrutura leve", "Promover experiências autênticas com comunidades locais"]', 1, NULL, '2025-11-13 00:21:18', '2025-11-13 00:21:18'),
	(45, 2671, '{"ano": "2025", "mes": "8", "feriado": "1", "temp_maxima": "0", "temp_minima": "0", "precipitacao": "1", "temperatura_media": "0", "localidade_Benguela": "1", "temp_maxima_historica": "0", "temp_minima_historica": "0", "temperatura_media_historica": "0", "precipitacao_media_historica": "1"}', 'Medio', '["Mapeamento e monitorização de indicadores ODS relevantes", "Estimular microcrédito para pequenos empreendedores turísticos", "Melhorar sinalética turística e informação em pontos centrais e postos de turismo", "Desenvolver plataformas online de reserva e estatísticas para gestores locais", "Programa de recolha de dados climáticos locais para melhorar previsões", "Criar parcerias com universidades para monitorização e pesquisa turística", "Instalar postos de hidratação e pontos de sombra em trilhos e praças", "Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)", "Criar roteiros auto-guiados com QR-codes em pontos de interesse", "Capacitar clubes e associações locais para gerir atrações menores"]', 1, NULL, '2025-11-13 00:22:48', '2025-11-13 00:22:48'),
	(46, 645, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "3434", "temp_minima": "4545", "precipitacao": "4544", "temperatura_media": "4432", "localidade_Lubango": "1", "temp_maxima_historica": "1222", "temp_minima_historica": "2342", "temperatura_media_historica": "34343", "precipitacao_media_historica": "2233"}', 'Medio', '["Programas de apoio a pequenas empresas locais para integrar cadeia de valor turística", "Melhorar a sinalização de segurança e normas para atividades de risco", "Campanhas de marketing direcionado para mercados emissores estratégicos", "Instalar postos de hidratação e pontos de sombra em trilhos e praças", "Promover produtos artesanais e gastronomia local em feiras", "Estimular microcrédito para pequenos empreendedores turísticos", "Manutenção periódica de trilhos e infraestrutura leve", "Parcerias com transportadoras para pacotes integrados (bus + atracção)", "Promover experiências autênticas com comunidades locais", "Oferecer formação em atendimento ao cliente e hospitalidade"]', 1, NULL, '2025-11-13 00:23:38', '2025-11-13 00:23:38'),
	(47, 2890, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "3434", "temp_minima": "4545", "precipitacao": "4544", "localidade_Luanda": "1", "temperatura_media": "4432", "temp_maxima_historica": "1222", "temp_minima_historica": "2342", "temperatura_media_historica": "34343", "precipitacao_media_historica": "2233"}', 'Medio', '["Iniciativas de promoção fora da época para reduzir sazonalidade", "Campanhas de marketing direcionado para mercados emissores estratégicos", "Estimular microcrédito para pequenos empreendedores turísticos", "Mapeamento e monitorização de indicadores ODS relevantes", "Criar directrizes de boas práticas para operadores de turismo local", "Melhorar sinalética turística e informação em pontos centrais e postos de turismo", "Promover produtos artesanais e gastronomia local em feiras", "Apoiar projetos de turismo comunitário e homestays sustentáveis", "Projetos de recuperação de espaços urbanos e praças para uso turístico", "Programas de formação em línguas básicas para recepção de estrangeiros"]', 1, NULL, '2025-11-13 00:23:49', '2025-11-13 00:23:49'),
	(48, 2683, '{"ano": "2025", "mes": "3", "feriado": "0", "temp_maxima": "3434", "temp_minima": "4545", "precipitacao": "4544", "temperatura_media": "4432", "localidade_Benguela": "1", "temp_maxima_historica": "1222", "temp_minima_historica": "2342", "temperatura_media_historica": "34343", "precipitacao_media_historica": "2233"}', 'Medio', '["Melhorar coleta e tratamento de resíduos em mercados e áreas recreativas", "Estimular microcrédito para pequenos empreendedores turísticos", "Melhorias moderadas na infraestrutura sanitária em pontos turísticos", "Desenvolver plataformas online de reserva e estatísticas para gestores locais", "Programa de recolha de dados climáticos locais para melhorar previsões", "Criar eventos culturais que valorizem património e atraiam públicos internacionais", "Fomentar cooperação entre municípios para partilha de melhores práticas", "Oferecer formação em atendimento ao cliente e hospitalidade", "Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade", "Criar roteiros auto-guiados com QR-codes em pontos de interesse"]', 1, NULL, '2025-11-13 00:24:02', '2025-11-13 00:24:02'),
	(49, 3208, '{"ano": "2022", "mes": "3", "feriado": "0", "temp_maxima": "3434", "temp_minima": "4545", "precipitacao": "4544", "temperatura_media": "4432", "localidade_Benguela": "1", "temp_maxima_historica": "1222", "temp_minima_historica": "2342", "temperatura_media_historica": "34343", "precipitacao_media_historica": "2233"}', 'Pico', '["Campanhas de educação do visitante sobre conservação e respeito à cultura local", "Introduzir sistema de reservas online para atrações mais concorridas", "Implementar sistema de feedback em tempo real para detetar problemas operacionais", "Promover seguro obrigatório para operadores que trabalham em períodos de pico", "Instalar sistemas de monitorização em tempo real (câmeras/contadores) para gerir lotação", "Coordenação com autoridades de saúde para aumentar vigilância sanitária", "Planos de rotação de eventos/feiras para distribuir impacto entre comunidades", "Certificação rápida de alojamentos que adotem práticas sustentáveis", "Implementar tarifação dinâmica / peak pricing para gerir procura", "Incentivar opções de refeição com ingredientes locais e práticas sustentáveis"]', 1, NULL, '2025-11-13 00:24:15', '2025-11-13 00:24:15'),
	(51, 2478, '{"ano": "2023", "mes": "3", "feriado": "0", "temp_maxima": "0", "temp_minima": "0", "precipitacao": "2", "temperatura_media": "0", "localidade_Benguela": "1", "temp_maxima_historica": "0", "temp_minima_historica": "0", "temperatura_media_historica": "0", "precipitacao_media_historica": "0"}', 'Medio', '["Melhorar coleta e tratamento de resíduos em mercados e áreas recreativas", "Estimular microcrédito para pequenos empreendedores turísticos", "Mapeamento e monitorização de indicadores ODS relevantes", "Melhorar a sinalização de segurança e normas para atividades de risco", "Fomentar cooperação entre municípios para partilha de melhores práticas", "Manutenção periódica de trilhos e infraestrutura leve", "Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade", "Desenvolver plataformas online de reserva e estatísticas para gestores locais", "Promover produtos artesanais e gastronomia local em feiras", "Implementar contentores de resíduos seletivos em zonas turísticas"]', 1, NULL, '2025-11-13 00:25:13', '2025-11-13 00:25:13'),
	(54, 3077, '{"ano": "2025", "mes": "3", "feriado": "1", "temp_maxima": "5", "temp_minima": "3", "precipitacao": "2", "temperatura_media": "3", "temp_maxima_historica": "6", "temp_minima_historica": "4", "temperatura_media_historica": "4", "precipitacao_media_historica": "1"}', 'Medio', '["Criar eventos culturais que valorizem património e atraiam públicos internacionais", "Melhorar a sinalização de segurança e normas para atividades de risco", "Desenvolver plataformas online de reserva e estatísticas para gestores locais", "Manutenção periódica de trilhos e infraestrutura leve", "Instalar postos de hidratação e pontos de sombra em trilhos e praças", "Parcerias com ONGs para projetos de conservação/empoderamento local", "Oferecer formação em atendimento ao cliente e hospitalidade", "Melhorar sinalética turística e informação em pontos centrais e postos de turismo", "Iniciativas de promoção fora da época para reduzir sazonalidade", "Programas de auditoria energética para estabelecimentos turísticos"]', 8, 1, '2025-11-13 17:02:32', '2025-11-13 17:02:32'),
	(55, 3811, '{"ano": "2022", "mes": "3", "feriado": "1", "temp_maxima": "8", "temp_minima": "5", "precipitacao": "4", "temperatura_media": "6", "temp_maxima_historica": "4", "temp_minima_historica": "5", "temperatura_media_historica": "7", "precipitacao_media_historica": "5"}', 'Medio', '["Criar parcerias com universidades para monitorização e pesquisa turística", "Programas de auditoria energética para estabelecimentos turísticos", "Programas de formação em línguas básicas para recepção de estrangeiros", "Incentivar transporte público local e rotas dedicadas a turistas", "Criar roteiros auto-guiados com QR-codes em pontos de interesse", "Implementar sistema de avaliação de experiência do visitante (NPS)", "Promover produtos artesanais e gastronomia local em feiras", "Projetos de recuperação de espaços urbanos e praças para uso turístico", "Promover experiências autênticas com comunidades locais", "Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade"]', 8, 1, '2025-11-13 19:18:54', '2025-11-13 19:18:54');

-- Copiando estrutura para tabela turistas3.item_sugestaos
CREATE TABLE IF NOT EXISTS `item_sugestaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sugestao_id` bigint unsigned NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_sugestaos_sugestao_id_foreign` (`sugestao_id`),
  CONSTRAINT `item_sugestaos_sugestao_id_foreign` FOREIGN KEY (`sugestao_id`) REFERENCES `sugestaos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.item_sugestaos: ~116 rows (aproximadamente)
REPLACE INTO `item_sugestaos` (`id`, `sugestao_id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Fazer qualquer coisa2', '2025-11-04 12:23:13', '2025-11-04 12:23:25'),
	(3, 1, 'Implementar sistema de gestão de capacidade (capacidade diária máxima) para pontos turísticos sensíveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(4, 1, 'Criar corredores exclusivos de transporte público para aliviar trânsito durante picos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(5, 1, 'Instalar estações temporárias de primeiros socorros e pontos de assistência em áreas de grande circulação', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(6, 1, 'Lançar programa de recolha e separação de resíduos para visitantes com contentores identificados', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(7, 1, 'Introduzir sistema de reservas online para atrações mais concorridas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(8, 1, 'Implementar tarifação dinâmica / peak pricing para gerir procura', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(9, 1, 'Aumentar a fiscalização e ordenamento de vendedores informais para reduzir impacto ambiental', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(10, 1, 'Criar centros de informação multilingue (português, inglês, francês) em hubs turísticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(11, 1, 'Promover rotas alternativas e turismo disperso para descongestionar pontos centrais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(12, 1, 'Instalar sinalética acessível e mapas táteis para pessoas com mobilidade reduzida', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(13, 1, 'Parcerias com hotéis para promover estadias mais longas e distribuição de fluxos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(14, 1, 'Instalar sistemas de monitorização em tempo real (câmeras/contadores) para gerir lotação', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(15, 1, 'Campanhas de educação do visitante sobre conservação e respeito à cultura local', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(16, 1, 'Criar medidas temporárias de controlo de ruído e horário de atividades noturnas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(17, 1, 'Implementar pontos de carregamento elétrico e incentivos ao uso de veículos sustentáveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(18, 1, 'Criar equipes de limpeza reforçadas durante a época de pico e sistemas de incentivos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(19, 1, 'Programa de contratação temporária local para reforçar serviços (hospitalidade, limpeza)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(20, 1, 'Criar fundos de compensação comunitária (taxa turística) para projetos ODS locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(21, 1, 'Introduzir regras temporárias de estacionamento e shuttle a partir de park & ride', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(22, 1, 'Certificação rápida de alojamentos que adotem práticas sustentáveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(23, 1, 'Instalar sanitários públicos adequados e manutenção reforçada', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(24, 1, 'Implementar controles e quotas em trilhos naturais para evitar erosão', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(25, 1, 'Monitorização do consumo de água e medidas de redução em pontos críticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(26, 1, 'Planos de emergência e evacuação ajustados para alta afluência', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(27, 1, 'Cartões/avisos digitais com informação sobre recicláveis e pontos de recolha', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(28, 1, 'Programas de promoção de produtos locais para aumentar receita comunitária', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(29, 1, 'Coordenação com autoridades de saúde para aumentar vigilância sanitária', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(30, 1, 'Sinalização eletrónica com lotação atual de atracções', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(31, 1, 'Acordos com operadores turísticos para escalonar visitas durante o dia', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(32, 1, 'Campanhas de sensibilização sobre fauna/flora endémica e restrições', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(33, 1, 'Estabelecer pontos de descanso e sombra para minimizar stress térmico dos visitantes', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(34, 1, 'Incentivar opções de refeição com ingredientes locais e práticas sustentáveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(35, 1, 'Criar programas de voluntariado de limpeza pós-eventos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(36, 1, 'Implementar sistemas de recolha e tratamento de águas residuais temporárias', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(37, 1, 'Oficinas de formação para guias turísticos sobre gestão de grandes grupos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(38, 1, 'Gestão de filas (digital/QR) e tempo médio de espera para reduzir aglomerações', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(39, 1, 'Implementar sistema de feedback em tempo real para detetar problemas operacionais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(40, 1, 'Planos de rotação de eventos/feiras para distribuir impacto entre comunidades', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(41, 1, 'Promover seguro obrigatório para operadores que trabalham em períodos de pico', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(42, 2, 'Programas de capacitação para guias locais sobre interpretação cultural e ambiental', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(43, 2, 'Melhorar sinalética turística e informação em pontos centrais e postos de turismo', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(44, 2, 'Criar rotas temáticas (cultural, ecológico, gastronómico) para diversificar oferta', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(45, 2, 'Programas de apoio a pequenas empresas locais para integrar cadeia de valor turística', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(46, 2, 'Implementar contentores de resíduos seletivos em zonas turísticas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(47, 2, 'Iniciativas de promoção fora da época para reduzir sazonalidade', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(48, 2, 'Criar eventos culturais que valorizem património e atraiam públicos internacionais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(49, 2, 'Promover certificações ambientais para alojamentos e operadores', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(50, 2, 'Desenvolver plataformas online de reserva e estatísticas para gestores locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(51, 2, 'Criar parcerias com universidades para monitorização e pesquisa turística', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(52, 2, 'Melhorias moderadas na infraestrutura sanitária em pontos turísticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(53, 2, 'Campanhas de marketing direcionado para mercados emissores estratégicos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(54, 2, 'Programas de formação em línguas básicas para recepção de estrangeiros', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(55, 2, 'Incentivar transporte público local e rotas dedicadas a turistas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(56, 2, 'Promover produtos artesanais e gastronomia local em feiras', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(57, 2, 'Instalar postos de hidratação e pontos de sombra em trilhos e praças', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(58, 2, 'Programas de auditoria energética para estabelecimentos turísticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(59, 2, 'Apoiar projetos de turismo comunitário e homestays sustentáveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(60, 2, 'Criar directrizes de boas práticas para operadores de turismo local', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(61, 2, 'Melhorar a sinalização de segurança e normas para atividades de risco', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(62, 2, 'Implementar sistema de avaliação de experiência do visitante (NPS)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(63, 2, 'Capacitar clubes e associações locais para gerir atrações menores', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(64, 2, 'Estabelecer pequenos incentivos fiscais para negócios que invistam em sustentabilidade', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(65, 2, 'Projetos de recuperação de espaços urbanos e praças para uso turístico', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(66, 2, 'Programas de sensibilização sobre conservação marinha e costeira', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(67, 2, 'Parcerias com transportadoras para pacotes integrados (bus + atracção)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(68, 2, 'Melhorar coleta e tratamento de resíduos em mercados e áreas recreativas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(69, 2, 'Criar roteiros auto-guiados com QR-codes em pontos de interesse', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(70, 2, 'Oferecer formação em atendimento ao cliente e hospitalidade', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(71, 2, 'Desenvolver campanhas de segurança para turistas (saúde, roubos, orientações)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(72, 2, 'Promover experiências autênticas com comunidades locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(73, 2, 'Manutenção periódica de trilhos e infraestrutura leve', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(74, 2, 'Parcerias com ONGs para projetos de conservação/empoderamento local', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(75, 2, 'Mapeamento e monitorização de indicadores ODS relevantes', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(76, 2, 'Fomentar cooperação entre municípios para partilha de melhores práticas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(77, 2, 'Criação de cartões turísticos com descontos em serviços locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(78, 2, 'Estimular microcrédito para pequenos empreendedores turísticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(79, 2, 'Programa de recolha de dados climáticos locais para melhorar previsões', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(80, 3, 'Campanhas de marketing internacional focadas em nichos (ecoturismo, cultural)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(81, 3, 'Incentivos fiscais para novos investimentos em alojamento sustentável', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(82, 3, 'Programas de capacitação para empreendedores locais em hospitalidade', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(83, 3, 'Desenvolver pacotes promocionais com operadores internacionais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(84, 3, 'Facilitar processos de vistos/entrada para turistas estrangeiros (parcerias)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(85, 3, 'Melhorar presença digital (site multilingue e SEO para a província)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(86, 3, 'Criar itinerários que combinem natureza e cultura para diferenciacao', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(87, 3, 'Organizar fam-trips para operadores e jornalistas estrangeiros', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(88, 3, 'Apoiar pequenas pousadas e guesthouses com microcréditos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(89, 3, 'Promover festivais culturais anuais para atrair visitantes', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(90, 3, 'Parcerias com companhias aéreas para rotas sazonais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(91, 3, 'Fomentar produtos locais (artesanato, gastronomia) como atrativo', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(92, 3, 'Investir em sinalética e acessibilidade básica em pontos turísticos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(93, 3, 'Programas de intercâmbio com universidades para projetos de investigação', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(94, 3, 'Criar incentivos para alojamentos obterem certificações sustentáveis', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(95, 3, 'Melhorar segurança e perceção de segurança para visitantes estrangeiros', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(96, 3, 'Desenvolver experiências de voluntariado sustentável que atraiam viajantes', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(97, 3, 'Pacotes de promoção combinando alojamento, transporte e experiências', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(98, 3, 'Oficinas de storytelling e branding para pequenos operadores locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(99, 3, 'Criar programas de turismo comunitário com repartição de receitas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(100, 3, 'Melhorar conectividade (internet) em locais de interesse turístico', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(101, 3, 'Campanhas de comunicação sobre património cultural e natural', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(102, 3, 'Estabelecer um selo de qualidade para serviços turísticos locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(103, 3, 'Incentivar investimentos em energias renováveis para pousadas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(104, 3, 'Promoção de roteiros seguros para turistas individuais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(105, 3, 'Apoiar projetos de conservação que possam ser visitáveis (edu-tourism)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(106, 3, 'Facilitar capacitação linguística básica para recepção de estrangeiros', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(107, 3, 'Promover viagens fora da época com descontos dirigidos', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(108, 3, 'Criar mercados semanais de produtos locais para turistas', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(109, 3, 'Parcerias com operadoras de turismo responsável', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(110, 3, 'Oferecer incentivos para melhoria de infra-estrutura rodoviária local', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(111, 3, 'Programas de microempreendedorismo para guias e condutores locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(112, 3, 'Desenvolver conteúdos digitais (vídeos, tours virtuais) sobre a província', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(113, 3, 'Promover experiências gastronómicas locais com rotas culinárias', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(114, 3, 'Programa de bolsas para formação de guias locais especializados', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(115, 3, 'Criar incubadoras de turismo sustentável para negócios locais', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(116, 3, 'Implementar políticas de acolhimento ao turista (pontos de informação)', '2025-11-04 19:03:42', '2025-11-04 19:03:42'),
	(117, 3, 'Criar mecanismos de monitorização de impacto e retorno económico local', '2025-11-04 19:03:42', '2025-11-04 19:03:42');

-- Copiando estrutura para tabela turistas3.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.migrations: ~12 rows (aproximadamente)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_11_02_212603_create_sugestaos_table', 1),
	(6, '2025_11_02_212604_create_item_sugestaos_table', 1),
	(7, '2025_11_03_000244_create_provincias_table', 1),
	(8, '2025_11_03_000259_create_gestores_table', 1),
	(9, '2025_11_03_000618_create_permission_tables', 1),
	(10, '2025_11_04_225856_create_historicos_table', 2),
	(11, '2025_11_05_131350_create_prestadores_table', 3),
	(12, '2025_11_05_131436_create_arquivos_table', 3);

-- Copiando estrutura para tabela turistas3.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.model_has_permissions: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.model_has_roles: ~14 rows (aproximadamente)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(3, 'App\\Models\\User', 3),
	(3, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(3, 'App\\Models\\User', 8),
	(3, 'App\\Models\\User', 9),
	(3, 'App\\Models\\User', 10),
	(3, 'App\\Models\\User', 11),
	(2, 'App\\Models\\User', 12),
	(2, 'App\\Models\\User', 13),
	(2, 'App\\Models\\User', 14),
	(2, 'App\\Models\\User', 15);

-- Copiando estrutura para tabela turistas3.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.permissions: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.prestadors
CREATE TABLE IF NOT EXISTS `prestadors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `contacto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prestadors_user_id_unique` (`user_id`),
  CONSTRAINT `prestadors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.prestadors: ~7 rows (aproximadamente)
REPLACE INTO `prestadors` (`id`, `user_id`, `contacto`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 5, NULL, NULL, '2025-11-05 13:43:13', '2025-11-05 13:43:13'),
	(2, 6, NULL, NULL, '2025-11-05 13:45:57', '2025-11-05 13:45:57'),
	(3, 7, NULL, NULL, '2025-11-06 21:39:08', '2025-11-06 21:39:08'),
	(4, 12, NULL, NULL, '2025-11-11 16:53:54', '2025-11-11 16:53:54'),
	(5, 13, NULL, NULL, '2025-11-11 22:05:17', '2025-11-11 22:05:17'),
	(6, 14, NULL, NULL, '2025-11-13 00:14:16', '2025-11-13 00:14:16'),
	(7, 15, NULL, NULL, '2025-11-13 19:21:02', '2025-11-13 19:21:02');

-- Copiando estrutura para tabela turistas3.provincias
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provincias_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.provincias: ~3 rows (aproximadamente)
REPLACE INTO `provincias` (`id`, `nome`, `created_at`, `updated_at`) VALUES
	(1, 'Luanda', '2025-11-04 12:28:56', '2025-11-04 12:31:40'),
	(2, 'Huila', '2025-11-04 12:29:49', '2025-11-04 12:29:49'),
	(3, 'Benguela', '2025-11-04 12:29:57', '2025-11-04 12:29:57');

-- Copiando estrutura para tabela turistas3.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.roles: ~3 rows (aproximadamente)
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2025-11-04 00:04:48', '2025-11-04 00:04:48'),
	(2, 'prestador', 'web', '2025-11-04 00:04:48', '2025-11-04 00:04:48'),
	(3, 'gestor', 'web', '2025-11-04 13:52:34', '2025-11-04 13:52:34');

-- Copiando estrutura para tabela turistas3.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.role_has_permissions: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela turistas3.sugestaos
CREATE TABLE IF NOT EXISTS `sugestaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.sugestaos: ~3 rows (aproximadamente)
REPLACE INTO `sugestaos` (`id`, `nome`, `created_at`, `updated_at`) VALUES
	(1, 'Pico', '2025-11-04 12:18:17', '2025-11-04 12:18:17'),
	(2, 'Medio', '2025-11-04 12:18:26', '2025-11-04 12:18:26'),
	(3, 'Baixo', '2025-11-04 12:18:35', '2025-11-04 12:18:52');

-- Copiando estrutura para tabela turistas3.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela turistas3.users: ~12 rows (aproximadamente)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$8OTNRNDB5SQeBD.HihAr0uz1Fnw6GHYadNWyRvKVEV6qHNnwnVk3e', NULL, '2025-11-04 00:04:48', '2025-11-04 00:04:48'),
	(5, 'linda', 'linda@gmail.com', NULL, '$2y$12$dwxyMQ7qmMg3LjJDpRWiwOW/zVbvMi2NarM35vSCZhmBUde.pYekq', NULL, '2025-11-05 13:43:13', '2025-11-05 13:43:13'),
	(6, 'Eusebio', 'eu@gmail.com', NULL, '$2y$12$enVCiStqGtscZYgDXdZhseuwDC5MT75ZoCMGghpAmCsbP7SY6ZTgW', NULL, '2025-11-05 13:45:57', '2025-11-05 13:45:57'),
	(7, 'dorivaldo', 'dorivaldo@gmail.com', NULL, '$2y$12$NL9booXcLBB/tJWmyKO94u2OLfP9GG6sp1RplQV43d99G8rq.mUV2', NULL, '2025-11-06 21:39:08', '2025-11-06 21:39:08'),
	(8, 'Luanda', 'luanda@gmail.com', NULL, '$2y$12$TQPIxxtaU3Or57b/jAjXUefC7urdjmHLGdQtIht5SlI2XrAz1Oage', NULL, '2025-11-11 16:31:40', '2025-11-11 16:31:40'),
	(9, 'Huila', 'huila@gmail.com', NULL, '$2y$12$F382CDw70XejvbKcmAI6Y.zPfMqPcXWRe4nksn.vRLlQVv8QqS9tG', NULL, '2025-11-11 16:33:05', '2025-11-11 16:33:05'),
	(10, 'Benguela', 'benguela@gmail.com', NULL, '$2y$12$pVtiNp9kxwIuBfrvrr7jaeQk0TqJDuNHmaUmDiXGmCofkU4AkURRu', NULL, '2025-11-11 16:33:37', '2025-11-11 16:33:37'),
	(11, 'Luanda2', 'luanda2@gmail.com', NULL, '$2y$12$9fWqkHaMMcg2yE70Pw771.HwQHhhbQR9F02xoYMYC03Njp4xQyH3W', NULL, '2025-11-11 16:40:46', '2025-11-11 16:40:46'),
	(12, 'bingo', 'bingo@gmail.com', NULL, '$2y$12$WHas8sDMg163A/hkhvUqs.vHHUVxmbxccJRl2N1aOsmYoJq6Ff1E.', NULL, '2025-11-11 16:53:54', '2025-11-11 16:53:54'),
	(13, 'jose', 'jose@gmail.com', NULL, '$2y$12$X4WDXTCvU2rntuGCsfxMrO1bczDTgMtj8enoP829YB7QVSLLznGbW', NULL, '2025-11-11 22:05:17', '2025-11-11 22:05:17'),
	(14, 'Carlos', 'carlos@gmail.com', NULL, '$2y$12$/i7Lb9WqMIdyHe08e6jVue83STynVJoMG/u0UC1CX74GgbCvrHTRK', NULL, '2025-11-13 00:14:16', '2025-11-13 00:14:16'),
	(15, 'carlos', 'carlos2@gmail.com', NULL, '$2y$12$jqysxVYTeM6T4XZnNy.FpezXG3TVQcFyQtCVPT2iV.0TfNBq0TazK', NULL, '2025-11-13 19:21:02', '2025-11-13 19:21:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
