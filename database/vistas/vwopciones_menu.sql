CREATE VIEW `vwopciones_menu` AS
SELECT         
		procesos.idempresa,
        procesos.idproceso,
        procesos.descripcion AS proceso,
        procesos.publicar,
        procesos.condicion AS condicionproceso,
        subprocesos.idsubproceso,
        subprocesos.descripcion AS subproceso,
        subprocesos.condicion AS condicionsubproceso,
        subprocesos.consecutivo,
        subprocesos.identificadorsubproceso,
        subprocesos.archivocreado
        
    FROM
        (procesos
        JOIN subprocesos ON ((procesos.idproceso = subprocesos.idproceso)))