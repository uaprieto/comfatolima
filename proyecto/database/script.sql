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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

-- Crear tabla de Clientes
DROP TABLE IF EXISTS clientes;

CREATE TABLE clientes (
    `documento` int(11) NOT NULL,
    `nombre` varchar(32) NOT NULL,
    `apellido` varchar(64) NOT NULL,
    `ciudad_id` int(5) NOT NULL,
    `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `activo` tinyint(1) NOT NULL DEFAULT '1'

);

--
-- Crear tabla de Departamentos
--
DROP TABLE IF EXISTS departamentos;

CREATE TABLE departamentos (
    `id` int(2) NOT NULL,
    `nombre` varchar(32) NOT NULL
);
-- Crear tabla de Ciudades
DROP TABLE IF EXISTS ciudades;

CREATE TABLE ciudades (
    `id` int(5) NOT NULL,
    `nombre` varchar(32) NOT NULL,
    `dto_id` int(2) NOT NULL
);

-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`documento`);

-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

-- Relaciones para las tablas
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`);

ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`dto_id`) REFERENCES `departamentos` (`id`);

-- Insertar datos en la tabla departamentos
INSERT INTO departamentos (id, nombre) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bolívar'),
(6, 'Boyacá'),
(7, 'Caldas'),
(8, 'Caquetá'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Chocó'),
(13, 'Córdoba'),
(14, 'Cundinamarca'),
(15, 'Guainía'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'La Guajira'),
(19, 'Magdalena'),
(20, 'Meta'),
(21, 'Nariño'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindío'),
(25, 'Risaralda'),
(26, 'San Andrés y Providencia'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupés'),
(32, 'Vichada');

-- Insertar datos en la tabla ciudades
INSERT INTO ciudades (id, nombre, dto_id) VALUES
(1, 'Leticia', 1),
(2, 'Medellín', 2),
(3, 'Arauca', 3),
(4, 'Barranquilla', 4),
(5, 'Cartagena', 5),
(6, 'Tunja', 6),
(7, 'Manizales', 7),
(8, 'Florencia', 8),
(9, 'Yopal', 9),
(10, 'Popayán', 10),
(11, 'Valledupar', 11),
(12, 'Quibdó', 12),
(13, 'Montería', 13),
(14, 'Bogotá', 14),
(15, 'Inírida', 15),
(16, 'San José del Guaviare', 16),
(17, 'Neiva', 17),
(18, 'Riohacha', 18),
(19, 'Santa Marta', 19),
(20, 'Villavicencio', 20),
(21, 'Pasto', 21),
(22, 'Cúcuta', 22),
(23, 'Mocoa', 23),
(24, 'Armenia', 24),
(25, 'Pereira', 25),
(26, 'San Andrés', 26),
(27, 'Bucaramanga', 27),
(28, 'Sincelejo', 28),
(29, 'Ibagué', 29),
(30, 'Cali', 30),
(31, 'Mitú', 31),
(32, 'Puerto Carreño', 32),
(33, 'Rioblanco', 29);
