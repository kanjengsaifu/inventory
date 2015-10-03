SELECT a.id_glasir, a.nama_glasir, 
		REPLACE(FORMAT(COALESCE(sum(case when g.deleted = 0 then g.c_ds_bgps else 0 end), 0),2),',','') as adj_bgps,
		REPLACE(FORMAT(COALESCE(sum(case when g.deleted = 0 then g.c_ds_sply else 0 end), 0),2),',','') as adj_supply,
		REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0),2),',','') as sab,
			REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0),2),',','') as sas 
FROM 
glasir a
LEFT JOIN glasir_adj g on a.id_glasir = g.id_glasir 
LEFT JOIN glasir_ohd b ON a.id_glasir = b.id_glasir
group by a.id_glasir