SELECT a.id_glasir,a.nama_glasir, 
	REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0),2),',','') as sab, 
	REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0),2),',','') as sas,
	REPLACE(FORMAT((COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)+
	COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 
		(SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)
	),2),',','')as gtot,
	REPLACE(FORMAT(COALESCE(sum(case when c.deleted <> 1 THEN (1.565*((c.densitas-1000)/1000)*c.volume) ELSE 0 END), 0),2),',','') as turun_bgps,
	REPLACE(FORMAT(COALESCE(sum(case when d.deleted <> 1 THEN (1.565*((d.densitas-1000)/1000)*d.volume) ELSE 0 END), 0),2),',','') as ditarik_supply,
	REPLACE(FORMAT(COALESCE(sum(case when e.deleted <> 1 THEN (1.565*((e.densitas-1000)/1000)*e.volume) ELSE 0 END), 0),2),',','') as return_prod,
	REPLACE(FORMAT(COALESCE(sum(case when f.deleted <> 1 THEN (1.565*((f.densitas-1000)/1000)*f.volume) ELSE 0 END), 0),2),',','') as kirim_prod,
	
	REPLACE(FORMAT(((COALESCE(sum(case when c.deleted <> 1 THEN (1.565*((c.densitas-1000)/1000)*c.volume) ELSE 0 END), 0)-COALESCE(sum(case when d.deleted <> 1 THEN (1.565*((d.densitas-1000)/1000)*d.volume) ELSE 0 END), 0))+COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = (SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)),2),',','') as stok_bgps,
	REPLACE(FORMAT(((COALESCE(sum(case when d.deleted <> 1 THEN (1.565*((d.densitas-1000)/1000)*d.volume) ELSE 0 END), 0)+COALESCE(sum(case when e.deleted <> 1 THEN (1.565*((e.densitas-1000)/1000)*e.volume) ELSE 0 END), 0))-COALESCE(sum(case when f.deleted <> 1 THEN (1.565*((f.densitas-1000)/1000)*f.volume) ELSE 0 END), 0)+COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = (SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)),2),',','') as stok_supply,
	REPLACE(FORMAT(((COALESCE(sum(case when c.deleted <> 1 THEN (1.565*((c.densitas-1000)/1000)*c.volume) ELSE 0 END), 0)-COALESCE(sum(case when d.deleted <> 1 THEN (1.565*((d.densitas-1000)/1000)*d.volume) ELSE 0 END), 0))+COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = (SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)) + 
	((COALESCE(sum(case when d.deleted <> 1 THEN (1.565*((d.densitas-1000)/1000)*d.volume) ELSE 0 END), 0)+COALESCE(sum(case when e.deleted <> 1 THEN (1.565*((e.densitas-1000)/1000)*e.volume) ELSE 0 END), 0))-COALESCE(sum(case when f.deleted <> 1 THEN (1.565*((f.densitas-1000)/1000)*f.volume) ELSE 0 END), 0)+COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = (SELECT DISTINCT MAX(g.period)  FROM glasir_ohd g) THEN b.bkg ELSE 0 END), 0)),2),',','') 
	as total
FROM glasir a
LEFT JOIN glasir_ohd b ON a.id_glasir = b.id_glasir
LEFT JOIN glasir_phd c ON a.id_glasir = c.id_glasir
LEFT JOIN glasir_phd_sp d ON a.id_glasir = d.id_glasir
LEFT JOIN glasir_rhd e ON a.id_glasir = e.id_glasir
LEFT JOIN glasir_rhd f ON a.id_glasir = f.id_glasir
group by a.id_glasir