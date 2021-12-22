<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE npaluno";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
    
    $sql ="
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database:  npaluno 
--

-- --------------------------------------------------------

--
-- Estrutura da tabela  auditoria 
--

CREATE TABLE  npaluno.auditoria  (
   id  int(11) NOT NULL,
   rotina  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   usuario  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   data  datetime NOT NULL,
   ip  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela  esqueci_senha 
--

CREATE TABLE  npaluno.esqueci_senha  (
   id  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   email  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   data  datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela  professor 
--

CREATE TABLE  npaluno.professor  (
   cpf  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   cod_setor  int(10) UNSIGNED NOT NULL,
   nome  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   senha  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   status  tinyint(1) DEFAULT NULL,
   email  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   admin  tinyint(1) DEFAULT NULL,
   telefone  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   acesso  datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela  professor_sda 
--

CREATE TABLE  npaluno.professor_sda  (
   cpf  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   cod_setor  int(10) UNSIGNED NOT NULL,
   nome  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   senha  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   status  tinyint(1) DEFAULT NULL,
   email  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   admin  boolean DEFAULT NULL,
   telefone  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
   acesso  date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela  questionario 
--

CREATE TABLE  npaluno.questionario  (
   codigo  int(11) NOT NULL,
   titulo  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   publico_alvo  varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   validade  date NOT NULL DEFAULT '3000-01-01',
   aviso_resposta  int(11) NOT NULL,
   professor  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
   inicio  date NOT NULL,
   publicar  int(11) NOT NULL,
   ativo  tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE  npaluno.setor  (
   cod_setor  int(10) UNSIGNED NOT NULL,
   descricao  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela  setor 
--

INSERT INTO  npaluno.setor  ( cod_setor ,  descricao ) VALUES
(1, 'ENGENHARIAS'),
(2, 'INFORMATICA'),
(3, 'CIENCIAS HUMANAS'),
(4, 'Direito'),
(5, 'Saude');

--
-- Indexes for dumped tables
--

--
-- Indexes for table  auditoria 
--
ALTER TABLE  npaluno.auditoria 
  ADD PRIMARY KEY ( id );

--
-- Indexes for table  esqueci_senha 
--
ALTER TABLE  npaluno.esqueci_senha 
  ADD PRIMARY KEY ( id );

--
-- Indexes for table  professor 
--
ALTER TABLE  npaluno.professor 
  ADD PRIMARY KEY ( cpf ),
  ADD KEY  PROFESSOR_FKIndex1  ( cod_setor );

--
-- Indexes for table  questionario 
--
ALTER TABLE  npaluno.questionario 
  ADD PRIMARY KEY ( codigo );

--
-- Indexes for table  setor 
--
ALTER TABLE  npaluno.setor 
  ADD PRIMARY KEY ( cod_setor );

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table  auditoria 
--
ALTER TABLE  npaluno.auditoria 
  MODIFY  id  int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table  questionario 
--
ALTER TABLE  npaluno.questionario 
  MODIFY  codigo  int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table  setor 
--
ALTER TABLE  npaluno.setor 
  MODIFY  cod_setor  int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


";
    $conn->exec($sql);
    echo "Table created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>