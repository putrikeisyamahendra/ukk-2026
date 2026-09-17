-- create_peminjamans_table

CREATE TABLE IF NOT EXISTS `peminjaman` (
    id_peminjaman         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user               INT UNISGNED NOT NULL,
    nis                 VARCHAR(20) NOT NULL,
    nama_peminjam       VARCHAR(255) NOT NULL,
    kelas               VARCHAR(10) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
