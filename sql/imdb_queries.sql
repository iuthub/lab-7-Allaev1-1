SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: imdb_queries
--

-- --------------------------------------------------------

--
-- Table structure for table imdb_queries
--

CREATE TABLE imdb_queries (
  number int(11) NOT NULL,
  query text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table imdb_queries
--

INSERT INTO imdb_queries (number, query) VALUES
(1, 'SELECT name FROM movies m\r\nWHERE m.year = 1995'),
(2, 'SELECT a.first_name, a.last_name FROM movies m\r\nJOIN roles r ON m.id = r.movie_id\r\nJOIN actors a ON r.actor_id = a.id\r\nWHERE m.name = \'Lost in Translation\''),
(3, 'SELECT d.first_name, d.last_name FROM directors d\r\nJOIN movies_directors md ON d.id = md.director_id\r\nJOIN movies m ON md.movie_id = m.id\r\nWHERE m.name = \'Fight Club\''),
(4, 'SELECT COUNT(*)\r\nFROM movies m\r\nJOIN movies_directors md ON m.id = md.movie_id\r\nJOIN directors d ON md.director_id = d.id\r\nWHERE d.first_name = \'Clint\' AND d.last_name = \'Eastwood\''),
(5, 'SELECT m.name\r\nFROM movies m\r\nJOIN movies_directors md ON m.id = md.movie_id\r\nJOIN directors d ON md.director_id = d.id\r\nWHERE d.first_name = \'Clint\' AND d.last_name = \'Eastwood\''),
(6, 'SELECT d.first_name, d.last_name FROM directors d\r\nJOIN directors_genres dg ON d.id = dg.director_id\r\nWHERE dg.genre = \'horror\''),
(7, 'SELECT DISTINCT a.first_name, a.last_name FROM actors a\r\nJOIN roles r ON a.id = r.actor_id\r\nJOIN movies m ON r.movie_id\r\nJOIN movies_directors md ON m.id = md.movie_id\r\nJOIN directors d ON md.director_id = d.id\r\nWHERE d.first_name = \'Christopher\' AND d.last_name = \'Nolan\'');

--
-- Indexes for dumped tables
--

--
-- Indexes for table imdb_queries
--
ALTER TABLE imdb_queries
  ADD PRIMARY KEY (number);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table imdb_queries
--
ALTER TABLE imdb_queries
  MODIFY number int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;