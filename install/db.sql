-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 30-Abr-2021 às 01:09
-- Versão do servidor: 10.3.25-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ckplayhd_gdrive`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ads`
--

CREATE TABLE `ads` (
  `id` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(25) DEFAULT NULL,
  `code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ads`
--

INSERT INTO `ads` (`id`, `title`, `type`, `code`) VALUES
(12, 'down_top', 'd_banner', 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KCWF0T3B0aW9ucyA9IHsNCgkJJ2tleScgOiAnZmJhNDY3YTFjYjJmNDYyYjMxZGRiYTk4Y2VkYjU4MmUnLA0KCQknZm9ybWF0JyA6ICdpZnJhbWUnLA0KCQknaGVpZ2h0JyA6IDkwLA0KCQknd2lkdGgnIDogNzI4LA0KCQkncGFyYW1zJyA6IHt9DQoJfTsNCglkb2N1bWVudC53cml0ZSgnPHNjcicgKyAnaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSJodHRwJyArIChsb2NhdGlvbi5wcm90b2NvbCA9PT0gJ2h0dHBzOicgPyAncycgOiAnJykgKyAnOi8vYWNjb21wYW5pbWVudGNvdWxkc3VycHJpc2luZ2x5LmNvbS9mYmE0NjdhMWNiMmY0NjJiMzFkZGJhOThjZWRiNTgyZS9pbnZva2UuanMiPjwvc2NyJyArICdpcHQ+Jyk7DQo8L3NjcmlwdD4='),
(14, 'down_left', 'd_banner', 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KCWF0T3B0aW9ucyA9IHsNCgkJJ2tleScgOiAnZmJhNDY3YTFjYjJmNDYyYjMxZGRiYTk4Y2VkYjU4MmUnLA0KCQknZm9ybWF0JyA6ICdpZnJhbWUnLA0KCQknaGVpZ2h0JyA6IDkwLA0KCQknd2lkdGgnIDogNzI4LA0KCQkncGFyYW1zJyA6IHt9DQoJfTsNCglkb2N1bWVudC53cml0ZSgnPHNjcicgKyAnaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSJodHRwJyArIChsb2NhdGlvbi5wcm90b2NvbCA9PT0gJ2h0dHBzOicgPyAncycgOiAnJykgKyAnOi8vYWNjb21wYW5pbWVudGNvdWxkc3VycHJpc2luZ2x5LmNvbS9mYmE0NjdhMWNiMmY0NjJiMzFkZGJhOThjZWRiNTgyZS9pbnZva2UuanMiPjwvc2NyJyArICdpcHQ+Jyk7DQo8L3NjcmlwdD4='),
(15, 'down_bottom', 'd_banner', 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KCWF0T3B0aW9ucyA9IHsNCgkJJ2tleScgOiAnMDJiNjY4OGU1NzFkY2MyNmU0OTk5YTgzZDA4NTNkZmQnLA0KCQknZm9ybWF0JyA6ICdpZnJhbWUnLA0KCQknaGVpZ2h0JyA6IDI1MCwNCgkJJ3dpZHRoJyA6IDMwMCwNCgkJJ3BhcmFtcycgOiB7fQ0KCX07DQoJZG9jdW1lbnQud3JpdGUoJzxzY3InICsgJ2lwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cCcgKyAobG9jYXRpb24ucHJvdG9jb2wgPT09ICdodHRwczonID8gJ3MnIDogJycpICsgJzovL2FjY29tcGFuaW1lbnRjb3VsZHN1cnByaXNpbmdseS5jb20vMDJiNjY4OGU1NzFkY2MyNmU0OTk5YTgzZDA4NTNkZmQvaW52b2tlLmpzIj48L3NjcicgKyAnaXB0PicpOw0KPC9zY3JpcHQ+'),
(16, 'popads', 'popad', 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIGRhdGEtY2Zhc3luYz0iZmFsc2UiPg0KLyo8IVtDREFUQVsvKiAqLw0KKGZ1bmN0aW9uKCl7dmFyIGFhYjc3ODk2NmZhNjg2NDM3ZDcxYzcyOWEyZWEzNjk1PSJFU3lZbnFqSkJyZnJTRTBlNjRVWW5kMk80OXBSb1ZHdDdGNV9reWdYbldKdTV2THFzMTl2bnJWMFctSXFlYWp4NDF5WTVOeUZOY3QzSHFQOE53Ijt2YXIgYT1bJ3c3SXZYSFhDcWNPYnc2RT0nLCdHVzl6dzZOVE9jT3pmeDQ4dzRQQ3IxND0nLCdKQWxxdzZnY3dvaz0nLCdmVUhDbDB2RG4zWENqUTF5VmpURHJ3PT0nLCdKeHpDaXNLRicsJ3dyZkRvc0tkUThLT0ljT2hPRU09JywndzVGQUxzT3FHY0tvYzhPRXdwa2p3NjNDaXdYQ29jT0R3NXQxdzZuQ2tXRSt3N1RDaHloRScsJ3dwckR2bmdtd3JaNnc3YkNuMERDa0NIQ3B4cDYnLCdlRXJEdHdKT3c2dkRrUnBDQ01LRScsJ3dyRENwOE81Y20vRHRjT29UZz09Jywnd28zRG1XbkR0RExEbWNLQUxtb2hHOEtyVjFvZHdwZkRuMG5Dc3NLTnc1dGNVVWNvQmNPcFljSzV3cU42TlJYRGpNT2xKeWc9JywnYXNLTmFjS3ZFc09hQU1LeHc2bkRzUVZIdzVmQ3RNS293NzBSd29naGVESVNSMUREa3c9PScsJ0xoYkNnY0syZE1PbFdYRT0nLCd3b3pEaU1LRXc3N0NtTU9GJywnZjEzRHZoQkl3NGpEbHc9PScsJ01IMFZ3cHJDamhzPScsJ3c1Sk9LY0toJywnYjEzRG9BVVN3NDdEZ2dWRUVzS0pBOEt1Q2xNPScsJ3dyMFZ3cEhDZ3NPdk9NS253b1ZOd3FIQ21zT2UnLCdIOEtzZHNLWEE4T0N3b2pEdDhLYXdxQUZ3by9DdjFZVnc0akRoWEREcGxrbHdxeFhWc091Q01PVUo4T2V3cTA5dzd2Q2c4SzVUUlBEazhPV0puQT0nLCdYTUtDdzdJQ1R3ckRoQ2tzd3F3PScsJ2ZNS0paOE92R3c9PScsJ3c3M0RzRmM9JywnQ3cvQ2w4S2N3cVJtJywndzRQRGc4TzF3bzl1dzQ5bndwWmd3N3d5WjhPVnc1UVB3b3JEbXNPa1BzSzUnLCdQRFBDbWd2Q3JzT1NGTU9kJywnRHo3RHNjS2hRY0tqRTFiQ2xoL0NvTUs4dzVnPScsJ3c2RXJ3cjNDb0ZBYlVzTy9ac084dzVmQ3NBPT0nXTsoZnVuY3Rpb24oYixjKXt2YXIgZD1mdW5jdGlvbihnKXt3aGlsZSgtLWcpe2JbJ3B1c2gnXShiWydzaGlmdCddKCkpO319O2QoKytjKTt9KGEsMHhiMSkpO3ZhciBiPWZ1bmN0aW9uKGMsZCl7Yz1jLTB4MDt2YXIgZT1hW2NdO2lmKGJbJ2VYUmx5YyddPT09dW5kZWZpbmVkKXsoZnVuY3Rpb24oKXt2YXIgaD1mdW5jdGlvbigpe3ZhciBrO3RyeXtrPUZ1bmN0aW9uKCdyZXR1cm5ceDIwKGZ1bmN0aW9uKClceDIwJysne30uY29uc3RydWN0b3IoXHgyMnJldHVyblx4MjB0aGlzXHgyMikoXHgyMCknKycpOycpKCk7fWNhdGNoKGwpe2s9d2luZG93O31yZXR1cm4gazt9O3ZhciBpPWgoKTt2YXIgaj0nQUJDREVGR0hJSktMTU5PUFFSU1RVVldYWVphYmNkZWZnaGlqa2xtbm9wcXJzdHV2d3h5ejAxMjM0NTY3ODkrLz0nO2lbJ2F0b2InXXx8KGlbJ2F0b2InXT1mdW5jdGlvbihrKXt2YXIgbD1TdHJpbmcoaylbJ3JlcGxhY2UnXSgvPSskLywnJyk7dmFyIG09Jyc7Zm9yKHZhciBuPTB4MCxvLHAscT0weDA7cD1sWydjaGFyQXQnXShxKyspO35wJiYobz1uJTB4ND9vKjB4NDArcDpwLG4rKyUweDQpP20rPVN0cmluZ1snZnJvbUNoYXJDb2RlJ10oMHhmZiZvPj4oLTB4MipuJjB4NikpOjB4MCl7cD1qWydpbmRleE9mJ10ocCk7fXJldHVybiBtO30pO30oKSk7dmFyIGc9ZnVuY3Rpb24oaCxsKXt2YXIgbT1bXSxuPTB4MCxvLHA9JycscT0nJztoPWF0b2IoaCk7Zm9yKHZhciB0PTB4MCx1PWhbJ2xlbmd0aCddO3Q8dTt0Kyspe3ErPSclJysoJzAwJytoWydjaGFyQ29kZUF0J10odClbJ3RvU3RyaW5nJ10oMHgxMCkpWydzbGljZSddKC0weDIpO31oPWRlY29kZVVSSUNvbXBvbmVudChxKTt2YXIgcjtmb3Iocj0weDA7cjwweDEwMDtyKyspe21bcl09cjt9Zm9yKHI9MHgwO3I8MHgxMDA7cisrKXtuPShuK21bcl0rbFsnY2hhckNvZGVBdCddKHIlbFsnbGVuZ3RoJ10pKSUweDEwMDtvPW1bcl07bVtyXT1tW25dO21bbl09bzt9cj0weDA7bj0weDA7Zm9yKHZhciB2PTB4MDt2PGhbJ2xlbmd0aCddO3YrKyl7cj0ocisweDEpJTB4MTAwO249KG4rbVtyXSklMHgxMDA7bz1tW3JdO21bcl09bVtuXTttW25dPW87cCs9U3RyaW5nWydmcm9tQ2hhckNvZGUnXShoWydjaGFyQ29kZUF0J10odilebVsobVtyXSttW25dKSUweDEwMF0pO31yZXR1cm4gcDt9O2JbJ1prWWVibiddPWc7Ylsnc1hNVmphJ109e307YlsnZVhSbHljJ109ISFbXTt9dmFyIGY9Ylsnc1hNVmphJ11bY107aWYoZj09PXVuZGVmaW5lZCl7aWYoYlsnZlpMTmpDJ109PT11bmRlZmluZWQpe2JbJ2ZaTE5qQyddPSEhW107fWU9YlsnWmtZZWJuJ10oZSxkKTtiWydzWE1WamEnXVtjXT1lO31lbHNle2U9Zjt9cmV0dXJuIGU7fTt2YXIgZD13aW5kb3c7ZFtiKCcweDE3JywnQTVPcicpXT1bW2IoJzB4NicsJ2JmbmonKSwweDIyYzc5OV0sW2IoJzB4MTUnLCdlblgxJyksMHgwXSxbYignMHgxYScsJ1s4ZE0nKSwnMCddLFtiKCcweDEyJywnJjNVMCcpLDB4MF0sW2IoJzB4NScsJzhUS2onKSwhW11dLFtiKCcweDExJywnVldJQicpLDB4MF0sW2IoJzB4OScsJ2R1RWQnKSwhMHgwXV07dmFyIHc9W2IoJzB4MScsJ2FMWSknKSxiKCcweGEnLCdyU0k5JyksYignMHgyJywnN3FRaicpLGIoJzB4MTknLCddYlpNJyldLG09MHgwLGssYz1mdW5jdGlvbigpe2lmKCF3W21dKXJldHVybjtrPWRbYignMHgzJywnUyRQcycpXVtiKCcweDE0JywnWUgwMCcpXShiKCcweDQnLCd1OWhaJykpO2tbYignMHg3JywnXWJaTScpXT1iKCcweDgnLCc4VEtqJyk7a1tiKCcweGMnLCc3cVFqJyldPSEweDA7dmFyIGU9ZFtiKCcweDEwJywnTWhOUycpXVtiKCcweGYnLCdjd29DJyldKGIoJzB4ZScsJ0E1T3InKSlbMHgwXTtrW2IoJzB4ZCcsJzdZQG4nKV09YignMHgwJywnUWQqRScpK3dbbV07a1tiKCcweDFiJywnOFRLaicpXT1iKCcweDE4Jywna0F1UCcpO2tbYignMHgxMycsJ2omb2cnKV09ZnVuY3Rpb24oKXttKys7YygpO307ZVtiKCcweGInLCdRNU1HJyldW2IoJzB4MTYnLCc5d05pJyldKGssZSk7fTtjKCk7fSkoKTsNCi8qXV0+LyogKi8NCjwvc2NyaXB0Pg=='),
(18, 'Anúncio de vídeo 01', 'vast', '{\"tag\":\"https:\\/\\/www.videosprofitnetwork.com\\/watch.xml?key=3545001a61b2d20254535e5cc50fc5c3\",\"offset\":\"0:01:00\",\"skipoffset\":\"5\"}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `uid` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `drive_auth`
--

CREATE TABLE `drive_auth` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 = active, 1 = failed',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `drive_auth`
--

INSERT INTO `drive_auth` (`id`, `client_id`, `client_secret`, `refresh_token`, `access_token`, `email`, `status`, `updated_at`, `created_at`) VALUES
(8, '488430148291-qegfchkl72sui97tbd2i5rgjde51ci9i.apps.googleusercontent.com', 'JgN5yRftNfToMEt9tt5b_BNn', '1//04Wl6CW5JKgoRCgYIARAAGAQSNwF-L9IrukL-u6oXRfR5jZiWM4FSL95CULJhY8_F4Q2e3e6GFT_H94aBYVHHvI3CtP-1ITKBeYY', '{\"access_token\":\"ya29.a0AfH6SMDU4CPzaESt5Ih6CPFSBN6Ic09OXwsGWYMXEae6q4crHZdg-V4xwt6yi2RRWow2OcHXsMmSkylinLPhHssqeZRdtHr1r5BjP1X9lJskAa6uAYGUE9OMsgcSCcDssuH5iD171OnpNEPSp5IWq5vzKePbV1U\",\"token_type\":\"Bearer\"}', 'mercadophp.com@gmail.com', 0, '2021-04-30 09:51:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `embed` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `preview` varchar(500) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 3,
  `source` varchar(20) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `files`
--

INSERT INTO `files` (`id`, `link`, `embed`, `slug`, `subtitle`, `preview`, `title`, `type`, `source`, `views`, `date`, `user`) VALUES
(7708, 'MTc0NzYxZDdhNeIDKFILfN8zvQzZZOs7SJC-hBOm3HqrxLJ_7TL4wGMxtRfXEQRjKsaM42Np7Sd1k8UOMRPidr6T', 'https://drive.google.com/file/d/1fboEVSG0JQEUVEzVgvH825xvm2FVZNgr/view?usp=sharing', 'Planeta-dos-macacos', 'NWFkMzYxZjk5ZphK_Km6nZTX7_RXN-fba9a8Gi2W3k1kjw', NULL, 'Planeta dos macacos', 3, 'drive', 10, '2020-10-23 20:56:46', 1),
(7710, 'NGJjOGRmMDUzM8t_JZ12uiij_jFiLyErS3wdsocaJUbkCibXabu3OLHGKvz1pRj2wLZMeiz3h4SiyWEtnxm-kW_S', 'https://drive.google.com/file/d/13jj2olf0UwpgYFJSh_xE5TwehPVYoKhN/view?usp=sharing', 'MT7wEH1RYtjRF5U', 'ODEwMzlkMDNiZsmjxOjcp2Um7OdqS5eie2pxo7VgU85Kcg', NULL, 'teste', 1, 'drive', 6, '2020-10-23 21:03:02', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `main_link` varchar(255) NOT NULL,
  `alt_link` varchar(255) DEFAULT NULL,
  `preview_img` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `type` varchar(50) DEFAULT 'direct',
  `subtitles` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `downloads` int(25) DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 = active,\r\n1 = inactive,\r\n2 = broken',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `links`
--

INSERT INTO `links` (`id`, `title`, `main_link`, `alt_link`, `preview_img`, `data`, `type`, `subtitles`, `views`, `downloads`, `slug`, `status`, `updated_at`, `created_at`, `deleted`) VALUES
(113, 'JujutsuNvenc1.mp4', 'https://drive.google.com/file/d/1ipV9s0HJG0IdzSjZ3nAVlgVnvC4cRNpd/view', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r1---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1615083826&ei=8gBEYNqOEPyCu7AP7JC1kA8&ip=67.23.238.29&cp=QVRGV0FfUlhQR1hPOjFuaXQwUGFMOG1LdEt6YkZ2QTRWVnUtQmtmTHY0dzZJZDE1eXFmT254WXM&id=5c213c68de177fc3&itag=18&source=webdrive&requiressl=yes&mh=Ib&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=1&pl=24&ttl=transient&susc=dr&driveid=1ipV9s0HJG0IdzSjZ3nAVlgVnvC4cRNpd&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=1435.109&lmt=1614055158716331&mt=1615068666&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRAIgE6rSbu7-WXwVg7HPpkX-uodkhSRiPOIr8ezYaQi2A28CIBhAfpC37GXdvAYHDAk-pDdsYRgkjKxtzmYZdp5_IxtS&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIgRDQs_rOw2pV3TKAREcV92IF-VxYLTUGRIoQXtrmKOiQCIQDIJjdNinWF2hBq_RMkc6T33hCFJ1pAqjV1G49zAoigPg==\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":68521270},\"720\":{\"file\":\"https:\\/\\/r1---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1615083826&ei=8gBEYNqOEPyCu7AP7JC1kA8&ip=67.23.238.29&cp=QVRGV0FfUlhQR1hPOjFuaXQwUGFMOG1LdEt6YkZ2QTRWVnUtQmtmTHY0dzZJZDE1eXFmT254WXM&id=5c213c68de177fc3&itag=22&source=webdrive&requiressl=yes&mh=Ib&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=1&pl=24&ttl=transient&susc=dr&driveid=1ipV9s0HJG0IdzSjZ3nAVlgVnvC4cRNpd&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=1435.109&lmt=1614055520717478&mt=1615068666&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAKD-RiVFdrFshc4KxkdW9kFb1Mm7X2k1EqTCI9r5HlzFAiBpeMVMyrrAszNROe42Nfb242Z-Ijs6-fIGnO2l0i9S-w==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRgIhAI2E-_rxgnucoTTd8UJ6AG05ia6ADrfwIjCEE3xJ9ENdAiEAm4b0A_fCCpc0ma-gf3e0zTvmNfzeQONgAPxTridTR0U=\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0}},\"cookies\":[\"DRIVE_STREAM=j4z69xVzc6k\",\"NID=210=rk010xxzlVPCMiTP0yShNqE_PLBl6f8_eErchCioM2YpUQPMvROU0liv5PchhdUK0ygX7fBTuAGjYZRrMqcm7KCxF8O3m1GOsFl0zKQgkcK-Yjf0qZxgu8pQsgr-rnnzeuOMdClUhFXlFLvkksHHjBgDHNvmmhOZX3I8SiXKlAw\",\"NID=210=Uqm9dfeID_3EUL5R0FSsaI3teUI8Mh0BZJtlwRDlvI2ywaRYjNF_XGezraJsHD7WCQkEspepGzEspaxIrYuW6kevE7H9tAptfSXespE3anL6HY8UNYbxzIgWVVqHLioFf409FpfEFCOoWqyW_zMmOXSxpdeN2O8OSU7upfTLmfg\"]}', 'GDrive', '', 5, 0, 'l8OCMAcdWR5ViJP', 0, '2021-03-07 06:57:51', '2021-02-25 08:45:50', 0),
(114, 'Tsteasd', 'https://drive.google.com/file/d/1udj7X54T0SJxLhedrg2GrGHUfaVZ0n7F/view', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r5---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1616224586&ei=CmlVYIn_Mrb7j-8Pgf6O0Ao&ip=67.23.238.29&cp=QVRGWENfU1VWR1hPOmZpUW1rZkNnMWVIOERhdE1PRGh4UDRPNG1qUGtPUUd4VzRwa0ZNT29OY2U&id=b15bb5f57739307c&itag=18&source=webdrive&requiressl=yes&mh=7F&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=5&pl=24&ttl=transient&susc=dr&driveid=1udj7X54T0SJxLhedrg2GrGHUfaVZ0n7F&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=313.840&lmt=1579276697504009&mt=1616209949&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRAIgFBVAv0RxrnyXj13h7ltkJ3QdAIGHxmm_5y6rcqtw9oICIFRx4qT-aq6ppyxfAcPRFqDf6tjHWOvLwZ-aQq3HQG85&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIgIyM2XDEraIuEpjImRwwjU7yJdrONTkO8GEFjlFZqPekCIQD_diGd19SHacSIAiScO1ic4nUKSL843UhoQZ84HU8phg==\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":25508916},\"720\":{\"file\":\"https:\\/\\/r5---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1616224586&ei=CmlVYIn_Mrb7j-8Pgf6O0Ao&ip=67.23.238.29&cp=QVRGWENfU1VWR1hPOmZpUW1rZkNnMWVIOERhdE1PRGh4UDRPNG1qUGtPUUd4VzRwa0ZNT29OY2U&id=b15bb5f57739307c&itag=22&source=webdrive&requiressl=yes&mh=7F&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=5&pl=24&ttl=transient&susc=dr&driveid=1udj7X54T0SJxLhedrg2GrGHUfaVZ0n7F&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=313.840&lmt=1579276704009594&mt=1616209949&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIgNRMysy83iqPsya3e_Mp4l1soQ4Nhk1VilSLUzSZznzoCIQDzqdRhfvZ2Vmx3oRpBUFg26KqOE9S5TRZAMDZcIJ4K2Q==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRgIhAPvPgEJutlKcWAW3pNrknhiltJrls0T-EdbAcGrqBR9QAiEA7go6e0BafQZok3r_q2v0JYErdN8cAhwYw2D9jAyTjPM=\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0},\"1080\":{\"file\":\"https:\\/\\/r5---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1616224586&ei=CmlVYIn_Mrb7j-8Pgf6O0Ao&ip=67.23.238.29&cp=QVRGWENfU1VWR1hPOmZpUW1rZkNnMWVIOERhdE1PRGh4UDRPNG1qUGtPUUd4VzRwa0ZNT29OY2U&id=b15bb5f57739307c&itag=37&source=webdrive&requiressl=yes&mh=7F&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=5&pl=24&ttl=transient&susc=dr&driveid=1udj7X54T0SJxLhedrg2GrGHUfaVZ0n7F&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=313.840&lmt=1579276731544746&mt=1616209949&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRgIhALfIb5NLT07CU0kI48SIgWit86bjLi6kuSNt89GlgBIhAiEA2LL5M9EyStjYG8cK_tr_H8iXQYesvaWHGppOviHabuo=&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRAIgc-xP1MxIU9y-p3BJJKxfI8DG9_AFE9k25IgbFGPTDWYCIH8rEgAPHT9qGunxwTj9Na6JwfELhv9RG8plWhmbWRbu\",\"quality\":\"1080\",\"type\":\"video\\/mp4\",\"size\":0},\"480\":{\"file\":\"https:\\/\\/r5---sn-a5msen7l.c.docs.google.com\\/videoplayback?expire=1616224586&ei=CmlVYIn_Mrb7j-8Pgf6O0Ao&ip=67.23.238.29&cp=QVRGWENfU1VWR1hPOmZpUW1rZkNnMWVIOERhdE1PRGh4UDRPNG1qUGtPUUd4VzRwa0ZNT29OY2U&id=b15bb5f57739307c&itag=59&source=webdrive&requiressl=yes&mh=7F&mm=32&mn=sn-a5msen7l&ms=su&mv=u&mvi=5&pl=24&ttl=transient&susc=dr&driveid=1udj7X54T0SJxLhedrg2GrGHUfaVZ0n7F&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=313.840&lmt=1579276660166326&mt=1616209949&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhALc_rSRsUGovga-JPbL1r9YwAIMxpZinh-R9N97j2UIgAiA75H5UlJPdGWHJc-mfVXkIOJmG6wMk6Q6CuegvgE-XsA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIgMwQo1_EeQ7a4CT_Fe5ihHNgcNwqP_BotACiFQfnO3RkCIQD_vIXJoFm4WetIa3NQJn-VxQ1bLqzxjeZPDrpiB_DCtw==\",\"quality\":\"480\",\"type\":\"video\\/mp4\",\"size\":0}},\"cookies\":[\"DRIVE_STREAM=MZt2U0uG4eY\",\"NID=211=abzd9jJGf0PM0TBHeoooBYciAp__tq0WSNQ3UiHBFLlU8n87PkGxss7XGKi7rjquiCLqLmWIPCeZlSkrjNJa-fSLJEJjI0MSWFFx9bsm3TiwuHWE0D937iEgq6YuKKX3-3AHduXINUXWap962YNKjMPVOZdo3yENuuOx-DFdPvM\",\"NID=211=Hp-SmJizBbmvyP2myD4wqGxhcv7sZyBw2NFsUIYtdfsRzn2pJqSVSwmQISQrwuMHzFXjoCHW7yNkprwZCiIioaulbkgGiDpOadlcaAmJnHYuWW57C-62LydrsIOysC_Owl2nt9T_ynRdQgM_qr3-ludF7JV1oterpFedKc9hoWI\"]}', 'GDrive', '', 14, 0, 'q9tOcjjgbBrbuJP', 0, '2021-03-20 11:46:28', '2021-02-28 05:28:35', 0),
(115, 'claudio', 'https://drive.google.com/file/d/1hXEHt6VU6oWwmmfNQwQ6N2o908J0qVT1/view?usp=sharing', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r1---sn-a5mekn7k.c.docs.google.com\\/videoplayback?expire=1619037649&ei=kVWAYJqVEPq6j-8P39qs-A4&ip=67.23.238.29&cp=QVRGQUFfVlZSSlhPOkVxWkNTRWxNQklvNVpZYWp6Qm1wQ3FzUzBiZmhweG1LZUdnNkRjczZqcFg&id=41ab159b60a80b3a&itag=18&source=webdrive&requiressl=yes&mh=kO&mm=32&mn=sn-a5mekn7k&ms=su&mv=u&mvi=1&pl=24&ttl=transient&susc=dr&driveid=1hXEHt6VU6oWwmmfNQwQ6N2o908J0qVT1&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=5771.064&lmt=1601149247283407&mt=1619022828&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIgNIKFWwda3G3wxvMthZM1GlUIgTSrmt9c9bOyAyAdM4MCIQDMjTTseR5jcLfA2js2PxkdYh7oYzoFwYFbBEyfJpjrTA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRgIhAKhM9d-C-WsQu-dyacumP0zLc14ZA3ExKVFSi6V2eys2AiEA-ECLnNnvCk3w3YHoWmigHINtXYQ7DxEi1iejyWbKAN4=\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":254401964},\"720\":{\"file\":\"https:\\/\\/r1---sn-a5mekn7k.c.docs.google.com\\/videoplayback?expire=1619037649&ei=kVWAYJqVEPq6j-8P39qs-A4&ip=67.23.238.29&cp=QVRGQUFfVlZSSlhPOkVxWkNTRWxNQklvNVpZYWp6Qm1wQ3FzUzBiZmhweG1LZUdnNkRjczZqcFg&id=41ab159b60a80b3a&itag=22&source=webdrive&requiressl=yes&mh=kO&mm=32&mn=sn-a5mekn7k&ms=su&mv=u&mvi=1&pl=24&ttl=transient&susc=dr&driveid=1hXEHt6VU6oWwmmfNQwQ6N2o908J0qVT1&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=5771.064&lmt=1601150413001685&mt=1619022828&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRgIhAIhLXwRA-iw--5vDfX4PN98lLO3tqEQRbyID3A8mkI7KAiEAj-xyqaCVlpCDNmVrtE8MzXf2IMhEQLRyw--NwuHK2xs=&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIhAKIk8ia3F5LNvedK-G-3e_P1Yvmh661KTgGbGkYwyTd9AiAFcdh4MRojfKQi9G_qeBdcOCpTmzIJreyLtk0ggb-Uvw==\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0}},\"cookies\":[\"DRIVE_STREAM=EKxvuo0hIKE\",\"NID=214=Y_DQ0tDvao1FjNLAC7OeosMgemHg2iIbrjFIgNCvTwUTQupKP__IAzBo_aDNOyYSsP_JL44q-IoVCXzKeJu2waB2HE9pvN7UCgNHvXucu0G5rwoh_ei3lgyZHTTIYkNrs1cmCgL8o-Trk9iBEXso-1IivzuypoUjUFqxlhzPbGs\",\"NID=214=SVxsM8zkRfhXqDUtwK7E8eHVZmzLRg-QE2V5PJq6mJHDGPNURXGFBnAklrHImU92YTK-uh3XdIqjPw8aEZt3EL6maLASUqoUdxbsx2lgB9piG1Q74QOK3pphml6fbM6zkJWDLOO17OTgm6Rc9YVPpGNdbK4uaENSsaK0ZlPYAIc\"]}', 'GDrive', '', 5, 0, 'eDVWMq6TzAf0Fn8', 0, '2021-04-22 01:10:50', '2021-03-05 07:17:20', 0),
(116, 'LCFRS03EP06.mp4', 'https://drive.google.com/file/d/1pe4tt2GUqMnfd6VxH89cHnTcDDYJuLjI/view?usp=sharing', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r4---sn-a5msen7s.c.docs.google.com\\/videoplayback?expire=1616275090&ei=Ui5WYK3cMJDoj-8PpKKPgAk&ip=67.23.238.29&cp=QVRGWENfVFBXQVhPOjYzR0tBOUwwWXNmNGZUcEJpRHYwQndaQzAtUG1uSW1yVWFpTzgwWjM3OTU&id=1a000bd7e3fc4bef&itag=18&source=webdrive&requiressl=yes&mh=QJ&mm=32&mn=sn-a5msen7s&ms=su&mv=u&mvi=4&pl=24&ttl=transient&susc=dr&driveid=1pe4tt2GUqMnfd6VxH89cHnTcDDYJuLjI&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=2652.903&lmt=1557444975101353&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRgIhALLbPXCyNtKNN36OcSCVmN8YTRfEpKN44OntkqZlIzzeAiEAqDMOAqn6goeOrwATSifd60Wb0gaKpjP09UzNOKvz_1E=&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRgIhAPg21XDIoau0AN_S5Sw20mp3ji3oYeczMqumbe9rlqpdAiEAvnKav7waw0A_hwlvoR5gk01QtTQUc3i4BtrJUmgl5Nc=\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":166387102},\"720\":{\"file\":\"https:\\/\\/r4---sn-a5msen7s.c.docs.google.com\\/videoplayback?expire=1616275090&ei=Ui5WYK3cMJDoj-8PpKKPgAk&ip=67.23.238.29&cp=QVRGWENfVFBXQVhPOjYzR0tBOUwwWXNmNGZUcEJpRHYwQndaQzAtUG1uSW1yVWFpTzgwWjM3OTU&id=1a000bd7e3fc4bef&itag=22&source=webdrive&requiressl=yes&mh=QJ&mm=32&mn=sn-a5msen7s&ms=su&mv=u&mvi=4&pl=24&ttl=transient&susc=dr&driveid=1pe4tt2GUqMnfd6VxH89cHnTcDDYJuLjI&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=2652.903&lmt=1557445073901919&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAIW_aJJUsFgWd38qCnK6R03DhC_YFUlkQI822VrcWtfpAiAtAqXaUYITCbRkJLVwyzgi6iPmsTzXheU_aV5LZr38mA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIgfya9xvjm8Wz_cKLtTAGkVctnaxMjjSI9hMtyVTcKBs0CIQCOR273LEp_piU1OwJFWxGgEkEogu-QLdZ--HxECQpRCQ==\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0},\"480\":{\"file\":\"https:\\/\\/r4---sn-a5msen7s.c.docs.google.com\\/videoplayback?expire=1616275090&ei=Ui5WYK3cMJDoj-8PpKKPgAk&ip=67.23.238.29&cp=QVRGWENfVFBXQVhPOjYzR0tBOUwwWXNmNGZUcEJpRHYwQndaQzAtUG1uSW1yVWFpTzgwWjM3OTU&id=1a000bd7e3fc4bef&itag=59&source=webdrive&requiressl=yes&mh=QJ&mm=32&mn=sn-a5msen7s&ms=su&mv=u&mvi=4&pl=24&ttl=transient&susc=dr&driveid=1pe4tt2GUqMnfd6VxH89cHnTcDDYJuLjI&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=2652.903&lmt=1557445049586219&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIgAWvSIIBm_IXbvUJiATAUQiTCqMVbnsFzBlw73XCJ0IQCIQDCNR14pWK5XLXZhD2qKgCV8zE1IRe6EJK58whKzDGEvQ==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRQIgCcc_vIR0nGIRpMNJdESHppgbuxZu6EGPP2njWwPW6CkCIQDX8W-1cBRWCJpT4TRdSESEcTGax957bxYqPlkOxsJAiA==\",\"quality\":\"480\",\"type\":\"video\\/mp4\",\"size\":0}},\"cookies\":[\"DRIVE_STREAM=ttvVSEifTb0\",\"NID=211=pAN1OLIDKzVN9gr2hTql60CZrWjUqV1s3P3fW5BzhpywNMT43dQyXGPsqT8eTwIoFC2pwCqISPnMmja12fg3PO_FrSfxeq-XVd8MyqXTzw2vaCldvo8neWmX0U4J7gB95oRbvHZLu9xJuQHTiE1qM8F9G6aEutM6WsPQJ1si-t0\",\"NID=211=JkbmawTtZrZFk93E1Z8dKcomYd2uTNqq81pJruRiBSoVtz2JmrXzxHavOqzuXwfJY6VvIjqq-8PK8iVz415EOZM9lqVz8R1sCkgmAM0UnJryitBWKU21ohIwvINy8E5F5r4LsHIUH3KBB0PP1q1Dgtic2VViO-cSWaQ4cZdh8CY\"]}', 'GDrive', '', 7, 0, 'CtQszPPUMwZGil1', 0, '2021-03-21 01:48:12', '2021-03-12 06:10:33', 0),
(117, 'Tttt', 'https://drive.google.com/file/d/1drckMjRERq2uARFv-SBKAG6G8SpjOiOq/preview', 'https://drive.google.com/file/d/1pe4tt2GUqMnfd6VxH89cHnTcDDYJuLjI/view', 'lucifer-banner-promocional.jpg', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r3---sn-hp57yn7y.c.docs.google.com\\/videoplayback?expire=1619754520&ei=2EWLYInPC8bdzLUPjv2Z8A4&ip=67.23.238.29&cp=QVRGQUhfU1VQQVhPOjJtbnpaVVdOR2U1QU1YMXFHSjltTnN3SHpUNGZILWd1Uy04ZUpNZEpaYk4&id=d145e5025a761e50&itag=18&source=webdrive&requiressl=yes&mh=Bx&mm=32&mn=sn-hp57yn7y&ms=su&mv=u&mvi=3&pl=24&ttl=transient&susc=dr&driveid=1drckMjRERq2uARFv-SBKAG6G8SpjOiOq&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=968.852&lmt=1619660455232432&mt=1619738921&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRgIhALgMe0TAGJ0qndvCZ5HPavsJLsy_W4vZdRE730BaLgHUAiEAkhLPVVHWb9PvyFo39pW5HsRAzb7f_xnAcm70nbUOEk8=&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRAIgV9gUwAir_sUFWWjX3FxWu_1DvV7AEINaxZn5VG4JyIACIFaxFTYtqmPdAypdECkK96PehCaP3lzmmEqCpdEYBQ8W\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":52398252},\"720\":{\"file\":\"https:\\/\\/r3---sn-hp57yn7y.c.docs.google.com\\/videoplayback?expire=1619754520&ei=2EWLYInPC8bdzLUPjv2Z8A4&ip=67.23.238.29&cp=QVRGQUhfU1VQQVhPOjJtbnpaVVdOR2U1QU1YMXFHSjltTnN3SHpUNGZILWd1Uy04ZUpNZEpaYk4&id=d145e5025a761e50&itag=22&source=webdrive&requiressl=yes&mh=Bx&mm=32&mn=sn-hp57yn7y&ms=su&mv=u&mvi=3&pl=24&ttl=transient&susc=dr&driveid=1drckMjRERq2uARFv-SBKAG6G8SpjOiOq&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=968.852&lmt=1619661718575720&mt=1619738921&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRAIgZxQ1pYdSEOwwL6dDNET19jmr19TlWRbZWq43CNgAUZoCIDaeypfbIB4Jzb14Db-XXypsm0cz2rcSmGtaLm0oET4n&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRAIgaoKtG72Z1qCEmHbaQ0PLRlT7GLpLnziIVo-L5DGBp6ECIAO5MW-3bfVGpvXUHmQZ_V8vHffYnZBJ8yzU-w0gfTZy\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":188577591},\"1080\":{\"file\":\"https:\\/\\/r3---sn-hp57yn7y.c.docs.google.com\\/videoplayback?expire=1619754520&ei=2EWLYInPC8bdzLUPjv2Z8A4&ip=67.23.238.29&cp=QVRGQUhfU1VQQVhPOjJtbnpaVVdOR2U1QU1YMXFHSjltTnN3SHpUNGZILWd1Uy04ZUpNZEpaYk4&id=d145e5025a761e50&itag=37&source=webdrive&requiressl=yes&mh=Bx&mm=32&mn=sn-hp57yn7y&ms=su&mv=u&mvi=3&pl=24&ttl=transient&susc=dr&driveid=1drckMjRERq2uARFv-SBKAG6G8SpjOiOq&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=968.852&lmt=1619662551621500&mt=1619738921&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAIvNg2tIo6gKgUm-fouE-gtMVqk2qqOl2sspbipKkSbkAiBXHWP9LmmeNYu9ihNFUhFXgHKOKR9ZbOUTPcBqAN53qw==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AG3C_xAwRgIhAO-FJh0c3KmCJk-bLuPc8pceSGID2KhISElcoHuQH0P2AiEAmXtZmTnGHeMSVInr-jS8S0nfmOyUBE5XkNZ0sFmisMA=\",\"quality\":\"1080\",\"type\":\"video\\/mp4\",\"size\":382540023}},\"cookies\":[\"DRIVE_STREAM=K_rNJM6oqCQ\",\"NID=214=mmKO389pKRW3kDnbaKxKCZStPSHdlnyDiWxoCeuFpvQRPsSJyJlK-zBj_QOdvzYmwIBCirR2Cba0pguBkJfGy3QcMGnnDViZDgxbBKVv5cotcQPMLVNCbL0U70Glky0Cyvlj2d6uolscA-Yjpuj75jPfTDNuej1MSaD1xdoLg3I\",\"NID=214=eE3R2nSgukHj2whHlkme8oTrdbK9FpZxhy1vcbuxDrL0Ep5bKbNP68D5AB9qunl-0tpggZ48sGBlcfofW10P2ekYnvwbS8BXftgnO1L3me004kOzhaczlRRVFlB7gqepezHY350R2NElNgUn2aXI80_MbIRW5v5wXLhyOsbRNIg\"]}', 'GDrive', '', 29, 5, 'teste', 0, '2021-04-30 09:19:10', '2021-03-13 11:32:54', 0),
(118, 'sdsdsds', 'https://drive.google.com/file/d/1B2XQHQV6A1OBKQwY48uwbvs4Rt4E1EGw/preview', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r5---sn-a5meknzs.c.docs.google.com\\/videoplayback?expire=1616275057&ei=MS5WYO_DBIOvzLUPiruWUA&ip=67.23.238.29&cp=QVRGWENfVFBTSFhPOnNaNUhIbkxvbG5uSURfYmdvNDRzeVRVVGFZaGFoSExULWw3NUZCN2ZPdVQ&id=f4902b14b888cf98&itag=18&source=webdrive&requiressl=yes&mh=xn&mm=32&mn=sn-a5meknzs&ms=su&mv=u&mvi=5&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1B2XQHQV6A1OBKQwY48uwbvs4Rt4E1EGw&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=14560.467&lmt=1616079470711830&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIgLfY6sgMIX5RHLC2GITM9iueluAYceGy_kZ3qoq6TzysCIQDisnyaYuyUVfEZAo2rM_2rYMnkQzGX9pNhjF0LqFn7vA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRQIgetwgb3fmahhet3KYSveyiXTYxlnskhyiD7lSuwFfr9wCIQCXVkSuojZdvDlSOBkS--zG3UiEKdENy6yZQ6UPmLadhw==\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":0},\"720\":{\"file\":\"https:\\/\\/r5---sn-a5meknzs.c.docs.google.com\\/videoplayback?expire=1616275057&ei=MS5WYO_DBIOvzLUPiruWUA&ip=67.23.238.29&cp=QVRGWENfVFBTSFhPOnNaNUhIbkxvbG5uSURfYmdvNDRzeVRVVGFZaGFoSExULWw3NUZCN2ZPdVQ&id=f4902b14b888cf98&itag=22&source=webdrive&requiressl=yes&mh=xn&mm=32&mn=sn-a5meknzs&ms=su&mv=u&mvi=5&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1B2XQHQV6A1OBKQwY48uwbvs4Rt4E1EGw&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=14560.467&lmt=1616081081534650&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRAIgF_Rlclk9O_83rffiQXvEwt41q6XaXCHH2Y-neM1C__kCIAyAz0wUnMI6pWZJU-ByoU6d5aaOMbf2imiM2wMbPq4q&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRQIgRpeM_y6sVK0_hmPnxxBRnREK6hfpqGMpDGLBcJTII3QCIQCM-cHRR0D41IKiF66e92Xwo6AkI3W4TMv2KCP-dhSuVw==\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0},\"1080\":{\"file\":\"https:\\/\\/r5---sn-a5meknzs.c.docs.google.com\\/videoplayback?expire=1616275057&ei=MS5WYO_DBIOvzLUPiruWUA&ip=67.23.238.29&cp=QVRGWENfVFBTSFhPOnNaNUhIbkxvbG5uSURfYmdvNDRzeVRVVGFZaGFoSExULWw3NUZCN2ZPdVQ&id=f4902b14b888cf98&itag=37&source=webdrive&requiressl=yes&mh=xn&mm=32&mn=sn-a5meknzs&ms=su&mv=u&mvi=5&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1B2XQHQV6A1OBKQwY48uwbvs4Rt4E1EGw&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=14560.467&lmt=1616080000639760&mt=1616260278&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAJuONzziJ1RjNcVNiUV4SZh33uxyfHVymPm4ihnYDHMMAiANJyGxA-IOLbo5hXsGqj5Pm7O-pqw9Spd2YCRLBmVaTg==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRAIgQFu3EaBCg6pRToe68wtrdyoEBJ3g0Axzk94aipFYHMICIHdChwwjtz60QnALe0oQfrVzRtIQfF7eXGXl4caOlsUk\",\"quality\":\"1080\",\"type\":\"video\\/mp4\",\"size\":5482739720}},\"cookies\":[\"DRIVE_STREAM=9nL9WTpi92s\",\"NID=211=g5DJ75Gt8VytE7YJnW4zixfsoSe1etpOOidjT27kBoTDvEkMNLVUWTzonykrXKKmrjXiGJus8U7bCbXNAtM-f7bu2ZZBlCbzzzAJDt18_1Fezmq2rPwHJvbQVJdkmKoynS6J7SRbTGWiuRgcQYB3ncFg7Gih37yJW93f1l0uLEU\",\"NID=211=OHh5QzqDJoSbdg_UicBO0c9cq4cLBRS9SvC1HaMLIez0tCE2wsD8rm2P86qOzpH4LCt4ZXyLKCfIHAHIA_61dpgBpzSp3BaA76uzR4kpUDDxOUZaDQbq9EHZWd8DJE8L2mGEJt9RmlrFx34C6ApRG2pY5Vd3W8e9d12ntMum2Gk\"]}', 'GDrive', '', 6, 0, 'H84YbHH5GrenRFI', 0, '2021-04-28 09:12:29', '2021-03-19 10:10:16', 0),
(120, 'teste', 'https://drive.google.com/file/d/1PSuGIYuDmotflQi83ODy6Ij850UdidGX/view?usp=sharing', '', '', '{\"sources\":{\"360\":{\"file\":\"https:\\/\\/r1---sn-hp57ynl6.c.docs.google.com\\/videoplayback?expire=1619760114&ei=sluLYKHeEbSfzLUP7bu36A4&ip=67.23.238.29&cp=QVRGQUhfT1FPRVhPOll1RXJlVHAzOHZXTk4xWklKeU4yck0zM2dvYWlkZkUxWll4ajhJSmFXTEM&id=fdb24b93b48d6056&itag=18&source=webdrive&requiressl=yes&mh=Sz&mm=32&mn=sn-hp57ynl6&ms=su&mv=u&mvi=1&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1PSuGIYuDmotflQi83ODy6Ij850UdidGX&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=6952.774&lmt=1611991510190281&mt=1619745029&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIgXUFqg-bK_x-VMPZXG6zdfxhNOd2rJepwUvF2pQVhLkMCIQCdR-IiCz0AsMiMUcFT57GBMwvlK0f_zp8mJxlBDUEPDA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRQIgfrjc19xoxk6Yy8-SHect3bYwlDfwtvDTTKvzojP7dL4CIQDbUbexDPXc-KiU5mpW4d-RbbZ86AhZz6_b-Ca9dZj0Aw==\",\"quality\":\"360\",\"type\":\"video\\/mp4\",\"size\":292793103},\"720\":{\"file\":\"https:\\/\\/r1---sn-hp57ynl6.c.docs.google.com\\/videoplayback?expire=1619760114&ei=sluLYKHeEbSfzLUP7bu36A4&ip=67.23.238.29&cp=QVRGQUhfT1FPRVhPOll1RXJlVHAzOHZXTk4xWklKeU4yck0zM2dvYWlkZkUxWll4ajhJSmFXTEM&id=fdb24b93b48d6056&itag=22&source=webdrive&requiressl=yes&mh=Sz&mm=32&mn=sn-hp57ynl6&ms=su&mv=u&mvi=1&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1PSuGIYuDmotflQi83ODy6Ij850UdidGX&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=6952.774&lmt=1611974034424820&mt=1619745029&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRgIhALFeALsY0p7-dTKVTbXlg2vLymAQDL23cecSDP0VP_lhAiEAhUhEGFMxvjXQbS0uwnM6XOvKx18zg_pzdYkAsQ4QEiY=&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRQIgEVRblX_fF1HHbDPC0Yt44O58Mv48cQfuIZ-2c9yIQ7kCIQCi2zDTePfjnm7R7WwFmqaror83pP2FogQRHrc0ph_cOg==\",\"quality\":\"720\",\"type\":\"video\\/mp4\",\"size\":0},\"1080\":{\"file\":\"https:\\/\\/r1---sn-hp57ynl6.c.docs.google.com\\/videoplayback?expire=1619760114&ei=sluLYKHeEbSfzLUP7bu36A4&ip=67.23.238.29&cp=QVRGQUhfT1FPRVhPOll1RXJlVHAzOHZXTk4xWklKeU4yck0zM2dvYWlkZkUxWll4ajhJSmFXTEM&id=fdb24b93b48d6056&itag=37&source=webdrive&requiressl=yes&mh=Sz&mm=32&mn=sn-hp57ynl6&ms=su&mv=u&mvi=1&pl=24&sc=yes&ttl=transient&susc=dr&driveid=1PSuGIYuDmotflQi83ODy6Ij850UdidGX&app=explorer&mime=video\\/mp4&vprv=1&prv=1&dur=6952.774&lmt=1611997745897916&mt=1619745029&sparams=expire%2Cei%2Cip%2Ccp%2Cid%2Citag%2Csource%2Crequiressl%2Cttl%2Csusc%2Cdriveid%2Capp%2Cmime%2Cvprv%2Cprv%2Cdur%2Clmt&sig=AOq0QJ8wRQIhALjvvs7unzecTUtb1HW2riTUOOWxRseuR3CSdKsPjyRSAiAq5tTwCDdZiLABQ8AVSTfpSLkP44SlKUGG-AQhFUa_xA==&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Csc&lsig=AG3C_xAwRgIhANLDV-BFLKBz8YLu3-SA3vie24x7tq82tjsGNFyXqmuBAiEAxxvRhPgKhJ3ptqKar3T5Ckcddqq7Xu1htGN3rLS6ISY=\",\"quality\":\"1080\",\"type\":\"video\\/mp4\",\"size\":0}},\"cookies\":[\"DRIVE_STREAM=oCsp-E0fS0I\",\"NID=214=Znx5qFJA07a6YOZUZtlFEB2gIDqdB_F8Tzl_imV932kKBr-6M4nRuP9lUDZBoGOgeueCywC0PDuQ69VN5tMrh9EKuhI91ly2AitJ2U45bqWV9iQvnHHjAtPU-b0OK0bMMGxtyw4xIrLyiU_fj9Pt2DAFHunDHOqK8Oj1A_IHqZ8\",\"NID=214=WtJrDZCH89QWE5K1Vc5Mh-jOu7iX4gdZghYashs1vVIyzuKblb53qqDfPHcv1mXuuKBbIxor3YgHjNhghb38zeUR1gSnVgZFnIZiiJWBbs27hs-zPzZbIG-QAlX-8sHy_V2RLD2oVUYbo9SOSwF7UXobRWk43fL6l8Sdk7VA2YQ\"]}', 'GDrive', '', 10, 0, 'WlHbVFlt1Q7o4Ht', 0, '2021-04-30 09:51:55', '2021-03-20 09:24:03', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `config` varchar(50) NOT NULL,
  `var` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`config`, `var`) VALUES
('version', '2.0'),
('firewall', '0'),
('auto_embed', ''),
('timezone', 'Asia/Colombo'),
('dark_theme', '1'),
('allowed_domains', '[]'),
('stream', '1'),
('ae_views', '0'),
('adminId', '1'),
('is_blocked', '0'),
('sublist', '[\"english\",\"spanish\",\"french\",\"hindi\",\"russian\"]'),
('proxyUser', ''),
('proxyPass', ''),
('player', 'jw'),
('playerSlug', 'v'),
('isDownload', '1'),
('isDownloadPage', '1'),
('defaultVideo', 'https://drive.google.com/drive/folders/1tSwuMMF-iNraUPdMivTaB1Su4aHWgegj?usp=sharing'),
('downloadPrefix', 'gdplyr_'),
('downloadSlug', 'd'),
('countdown', '0'),
('downloadPageContent', '&lt;h2&gt;Fa&ccedil;a o download&lt;/h2&gt;'),
('logo', ''),
('favicon', ''),
('a', '1279672'),
('autoEmbed', '1'),
('streamLink', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `img`, `role`, `status`) VALUES
(1, 'admin', '$2y$10$8q6xxp3hB/8HnNCj.F7ptue8FNPh6Tz6jS8mv8ot3h3rSCNqbIFDG', '495-4953926_admin-icon-png-white-clipart-png-download-black.png', 'admin', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `drive_auth`
--
ALTER TABLE `drive_auth`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `drive_auth`
--
ALTER TABLE `drive_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
