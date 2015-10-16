SELECT a.id, a.nama,b.nama as buyer, 
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Tkw1k,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Tkw1s,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Tkw1b,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Tkw2k,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Tkw2s,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Tkw2b,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Tkw3k,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Tkw3s,
SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Tkw3b
FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_rhd h ON h.id_decal_items = a.id
WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer