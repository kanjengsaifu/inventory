SELECT a.id, a.nama,b.nama as buyer, 
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1b,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2b,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3b
                                FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_phd e ON e.id_decal_items = a.id
                                WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer