CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'tecnico', 'operador') NOT NULL DEFAULT 'operador',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    fabricante VARCHAR(100),
    modelo VARCHAR(100),
    estado ENUM('Operativo', 'Fuera de servicio', 'En mantenimiento') NOT NULL DEFAULT 'Operativo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS paros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    mes INT NOT NULL,
    area VARCHAR(100),
    ubicacion_tecnica VARCHAR(100),
    equipo_id INT NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME,
    total_horas FLOAT,
    secuencia VARCHAR(100) NOT NULL,
    causa VARCHAR(100) NOT NULL,
    sintoma VARCHAR(150),
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS avisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo_id INT NOT NULL,
    fecha_reporte DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reportado_por VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad ENUM('Alta', 'Media', 'Baja') NOT NULL,
    estado ENUM('Pendiente', 'En revisión', 'Cerrado') NOT NULL DEFAULT 'Pendiente',
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ordenes_trabajo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo_id INT NOT NULL,
    aviso_id INT DEFAULT NULL,
    tipo_mantenimiento ENUM('Correctivo', 'Preventivo') NOT NULL,
    descripcion TEXT NOT NULL,
    tecnico INT NULL,
    fecha_programada DATE,
    fecha_inicio DATETIME,
    fecha_cierre DATETIME,
    estado ENUM('Pendiente', 'En proceso', 'Finalizada') NOT NULL DEFAULT 'Pendiente',
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE,
    FOREIGN KEY (aviso_id) REFERENCES avisos(id) ON DELETE SET NULL,
    FOREIGN KEY (tecnico) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Contraseña por defecto: admin
INSERT IGNORE INTO usuarios (id, nombre, email, password, rol) VALUES 
(1, 'Administrador', 'admin@atlasmaint.com', '$2y$10$ftPFCRTl1WEXTnAJRI3/.ONfr176KMCs/8L7HHyWitqWr7RF2xGVK', 'admin');
