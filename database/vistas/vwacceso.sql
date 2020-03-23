CREATE VIEW `vwacceso` AS
    SELECT 
        s.idsuscriptor,
        s.nombre_empresa,
        s.rfc,
        s.limite_usuarios,
        s.carpeta,
        s.capacidad_almacenamiento,
        s.condicion AS condicion_suscriptor,
        u.idusuario_suscriptor,
        u.nombre_completo,
        u.nombre_usuario,
        u.perfil,
        u.email,
        u.password_usuario,
        u.intentos,
        u.condicion AS condicion_usuario,
        u.foto,       
        s.descripcion,
        s.logo,
        s.encabezado
    FROM
        tblempresas AS s
            JOIN
        tblusuarios AS u ON s.idsuscriptor = u.idsuscriptor