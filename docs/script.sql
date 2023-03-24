CREATE database manager_xml;

use manager_xml;

CREATE TABLE `nft` (
  `id` int NOT NULL,
  `path_nf` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `number_nf` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_emiter` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `nft`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `nft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


