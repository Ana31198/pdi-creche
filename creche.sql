-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Abr-2025 às 17:56
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `creche`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_lusia@gmail.com|127.0.0.1', 'i:1;', 1743004516),
('laravel_cache_lusia@gmail.com|127.0.0.1:timer', 'i:1743004516;', 1743004516),
('laravel_cache_teste@gmail.com|127.0.0.1', 'i:1;', 1742482184),
('laravel_cache_teste@gmail.com|127.0.0.1:timer', 'i:1742482184;', 1742482184);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hora_abertura` time DEFAULT NULL,
  `hora_fechamento` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `hora_abertura`, `hora_fechamento`, `created_at`, `updated_at`) VALUES
(1, '11:00:00', '18:00:00', '2025-03-25 21:16:54', '2025-03-27 15:10:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criancas`
--

CREATE TABLE `criancas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nomeresponsavel` varchar(255) NOT NULL,
  `graudeparentescodoresponsavel` varchar(255) NOT NULL,
  `contactodoresponsavel` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `criancas`
--

INSERT INTO `criancas` (`id`, `created_at`, `updated_at`, `nome`, `genero`, `data_nascimento`, `nomeresponsavel`, `graudeparentescodoresponsavel`, `contactodoresponsavel`, `image`) VALUES
(5, '2025-03-19 16:29:02', '2025-03-19 16:29:02', 'Jessica', 'Feminino', '2024-03-19', 'ana', 'Mae', '915578908', 'img/criancas/1742401742_jessica.jpg'),
(6, '2025-03-19 16:33:10', '2025-03-19 16:33:10', 'Martim', 'Masculino', '2025-06-22', 'luis', 'pai', '923456287', 'img/criancas/1742401990_martim.jpg'),
(7, '2025-03-20 17:08:13', '2025-03-20 17:08:13', 'Maria', 'Feminino', '2020-03-18', 'ana', 'mae', '915570657', 'img/criancas/1742490493_jessica.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE `fotos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crianca_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `caminho` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `fotos`
--

INSERT INTO `fotos` (`id`, `crianca_id`, `titulo`, `descricao`, `caminho`, `created_at`, `updated_at`) VALUES
(1, 5, 'Passeio ao campo', 'Passeio ao campo de papoilas', 'img/criancas/1742401742_jessica.jpg', '2025-03-19 17:38:47', '2025-03-19 17:38:47'),
(2, 5, 'Passeio ao campo', 'outro', 'fotos/XBzavRwkSA21EeEQMFy6uHs5IQR7P6sN4FWt5tXs.jpg', '2025-03-19 17:46:21', '2025-03-19 17:46:21'),
(3, 6, 'Passeio ao campo', 'ver um quintal', 'fotos/zWgoWhDyKocEETqvgg7oqHZUaoy51IFYbPRPdM8N.jpg', '2025-03-26 18:04:01', '2025-03-26 18:04:01'),
(4, 7, 'teste', 'teste', 'fotos/ntyBLzoz5PsMp7md22TiByLI9hebg8vGjH31QTS5.jpg', '2025-03-27 18:10:09', '2025-03-27 18:10:09'),
(5, 5, 'g', 'h', 'fotos/GeElGVP5U1JQpdwbwoeneSO4qgnfE9bJso0ENmKT.jpg', '2025-03-27 18:10:28', '2025-03-27 18:10:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(44, '0001_01_01_000000_create_users_table', 1),
(45, '0001_01_01_000001_create_cache_table', 1),
(46, '0001_01_01_000002_create_jobs_table', 1),
(47, '2025_02_27_155711_create_criancas_table', 1),
(48, '2025_02_27_183558_add_image_to_criancas_table', 1),
(49, '2025_03_04_222810_create_rotinas_table', 1),
(50, '2025_03_05_005914_create_presencas_table', 1),
(51, '2025_03_05_120641_update_presencas_table', 1),
(52, '2025_03_05_123620_add_saida_to_presencas_table', 1),
(53, '2025_03_05_124324_add_retirado_por_to_presencas_table', 1),
(54, '2025_03_11_220933_create_fotografias_table', 1),
(55, '2025_03_12_180157_add_funcao_to_users_table', 1),
(56, '2025_03_19_173742_create_fotos_table', 2),
(57, '2025_03_20_175030_create_configuracoes_table', 3),
(58, '2025_03_25_211534_create_configuracoes_table', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `presencas`
--

CREATE TABLE `presencas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crianca_id` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `saida` time DEFAULT NULL,
  `retirado_por` varchar(255) DEFAULT NULL,
  `tipo` enum('entrada','saida') NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `presencas`
--

INSERT INTO `presencas` (`id`, `crianca_id`, `data`, `responsavel`, `created_at`, `updated_at`, `hora`, `saida`, `retirado_por`, `tipo`) VALUES
(6, 5, '2025-03-19', 'Ana', '2025-03-19 16:35:37', '2025-03-19 16:35:49', '10:00:00', '16:35:49', 'Ana', 'entrada'),
(7, 6, '2025-03-20', 'luis', '2025-03-20 17:36:52', '2025-03-26 15:16:40', '10:00:00', '15:16:40', 'luis', 'entrada'),
(8, 5, '2025-03-24', 'ana', '2025-03-25 21:40:35', '2025-03-26 15:16:44', '10:00:00', '15:16:44', 'ana', 'entrada'),
(9, 6, '2025-03-25', 'luis', '2025-03-25 21:42:53', '2025-03-25 21:48:10', '10:00:00', '21:48:10', 'luis', 'entrada'),
(10, 5, '2025-03-24', 'ana', '2025-03-25 21:43:14', '2025-03-26 15:16:51', '10:00:00', '15:16:51', 'ana', 'entrada'),
(11, 7, '2025-03-24', 'ana', '2025-03-25 21:43:32', '2025-03-26 15:16:48', '10:00:00', '15:16:48', 'ana', 'entrada'),
(12, 5, '2025-03-25', 'ana', '2025-03-25 21:43:46', '2025-03-25 21:48:14', '10:00:00', '21:48:14', 'ana', 'entrada'),
(13, 5, '2025-03-25', 'ana', '2025-03-25 21:44:15', '2025-03-25 21:48:17', '06:00:00', '21:48:17', 'ana', 'entrada'),
(14, 6, '2025-03-25', 'luis', '2025-03-25 23:23:14', '2025-03-25 23:36:54', '10:00:00', '23:36:54', 'luis', 'entrada'),
(15, 7, '2025-03-25', 'ana', '2025-03-25 23:23:44', '2025-03-25 23:36:58', '06:00:00', '23:36:58', 'ana', 'entrada'),
(16, 6, '2025-03-25', 'luis', '2025-03-25 23:26:47', '2025-03-25 23:37:02', '06:00:00', '23:37:02', 'luis', 'entrada'),
(17, 6, '2025-03-25', 'luis', '2025-03-25 23:28:36', '2025-03-25 23:37:06', '10:00:00', '23:37:06', 'luis', 'entrada'),
(18, 6, '2025-03-25', 'luis', '2025-03-25 23:38:52', '2025-03-26 15:17:04', '10:00:00', '15:17:04', 'luis', 'entrada'),
(19, 6, '2025-03-26', 'luis', '2025-03-26 12:11:55', '2025-03-26 12:25:11', '23:02:00', '12:25:11', 'luis', 'entrada'),
(20, 7, '2025-03-26', 'ana', '2025-03-26 12:12:55', '2025-03-26 12:29:05', '23:30:00', '12:29:05', 'ana', 'entrada'),
(21, 7, '2025-03-26', 'ana', '2025-03-26 12:59:42', '2025-03-26 13:10:31', '16:09:00', '13:10:31', 'ana', 'entrada'),
(22, 5, '2025-03-26', 'ana', '2025-03-26 15:40:59', '2025-03-26 15:47:00', '17:00:00', '15:47:00', 'ana', 'entrada'),
(23, 5, '2025-03-26', 'ana', '2025-03-26 15:49:05', '2025-03-26 15:53:16', '11:00:00', '15:53:16', 'luis', 'entrada'),
(24, 6, '2025-03-26', 'luis', '2025-03-26 15:49:43', '2025-03-26 15:56:04', '11:00:00', '15:56:04', 'ana', 'entrada'),
(25, 7, '2025-03-26', 'ana', '2025-03-26 15:54:36', '2025-03-26 15:56:13', '14:00:00', '15:56:13', 'luis', 'entrada'),
(26, 7, '2025-03-26', 'ana', '2025-03-26 15:56:48', '2025-03-26 15:57:35', '11:00:00', '15:57:35', 'luisa', 'entrada'),
(27, 5, '2025-03-26', 'ana', '2025-03-26 16:00:01', '2025-03-26 16:21:33', '10:01:00', '16:21:33', 'ana', 'entrada'),
(28, 6, '2025-03-26', 'luis', '2025-03-26 18:02:43', '2025-03-26 18:19:19', '11:01:00', '18:19:19', 'luis', 'entrada'),
(29, 7, '2025-03-27', 'ana', '2025-03-27 15:35:26', '2025-04-03 12:53:29', '11:01:00', '13:53:29', 'ana', 'entrada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotinas`
--

CREATE TABLE `rotinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crianca_id` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `atividade` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `rotinas`
--

INSERT INTO `rotinas` (`id`, `crianca_id`, `data`, `atividade`, `descricao`, `created_at`, `updated_at`) VALUES
(8, 5, '2025-03-19', 'Troca de fralda', 'Troca da primeira fralda', '2025-03-19 16:30:16', '2025-03-19 16:30:16'),
(9, 6, '2025-03-20', 'Troca de fralda', 'teste', '2025-03-20 15:00:46', '2025-03-20 15:00:46'),
(10, 5, '2025-01-10', 'alimnetacao', 'teste', '2025-03-20 15:01:32', '2025-03-20 15:01:32'),
(11, 5, '2025-03-19', 'Comer o lanche', 'comeu a fruta', '2025-03-20 15:31:47', '2025-03-20 15:31:47'),
(12, 7, '2025-03-19', 'Comer o lanche muoto bem ', 'comeu a fruta', '2025-03-20 15:31:47', '2025-03-20 15:31:47'),
(13, 6, '2020-03-26', 'Troca de fralda', 'coco', '2025-03-26 13:04:27', '2025-03-26 13:04:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('J30hm1KGUQSDgLP8HmgAhzcxe2DNFi7lLJlQ5w6w', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieUhQY0hxTFd5d0ttV3ZMTEk2TnFwRW5nY3pHZW1ydnFUR3IzekhjMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1743688357),
('UoknlYRwsjq6dlswpni1LrOgDsrpGCKeDhDqxZS6', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEM3VzV3OTFLdFhXaTFtbVpOelAwVEM0amJQaUJiaHl0OWd6bHViayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3RvcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=', 1743693529);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'pai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(9, 'Admin', 'admin@gmail.com', NULL, '$2y$12$ZhjlxKpR1G.sLjvbcKbI7u26X3mz8jEPaJShjIe6JROYcck9I6z/C', NULL, '2025-03-19 16:14:18', '2025-03-19 16:14:18', 'admin'),
(10, 'ana', 'ana@gmail.com', NULL, '$2y$12$ZhjlxKpR1G.sLjvbcKbI7u26X3mz8jEPaJShjIe6JROYcck9I6z/C', NULL, '2025-03-19 16:14:18', '2025-03-19 16:14:18', 'pai'),
(11, 'luisa', 'luisa@gmail.com', NULL, '$2y$12$ZhjlxKpR1G.sLjvbcKbI7u26X3mz8jEPaJShjIe6JROYcck9I6z/C', NULL, '2025-03-19 16:14:18', '2025-03-19 16:14:18', 'educador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `criancas`
--
ALTER TABLE `criancas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotos_crianca_id_foreign` (`crianca_id`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `presencas`
--
ALTER TABLE `presencas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presencas_crianca_id_foreign` (`crianca_id`);

--
-- Índices para tabela `rotinas`
--
ALTER TABLE `rotinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rotinas_crianca_id_foreign` (`crianca_id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `criancas`
--
ALTER TABLE `criancas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `presencas`
--
ALTER TABLE `presencas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `rotinas`
--
ALTER TABLE `rotinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_crianca_id_foreign` FOREIGN KEY (`crianca_id`) REFERENCES `criancas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `presencas`
--
ALTER TABLE `presencas`
  ADD CONSTRAINT `presencas_crianca_id_foreign` FOREIGN KEY (`crianca_id`) REFERENCES `criancas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `rotinas`
--
ALTER TABLE `rotinas`
  ADD CONSTRAINT `rotinas_crianca_id_foreign` FOREIGN KEY (`crianca_id`) REFERENCES `criancas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
