-- Create table usuarios
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    `id` int NOT NULL,
    `nombre` varchar(32) NOT NULL,
    `correo` varchar(64) NOT NULL UNIQUE,
    `clave` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `activo` tinyint(1) NOT NULL DEFAULT '1'

);
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;
