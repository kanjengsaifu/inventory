SELECT a.id, a.nama,b.nama as buyer, 
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1k,
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1s,
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1b,
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1ksb,
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2k,
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2s,
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2b,
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2ksb,
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3k,
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3s,
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3b,
SUM(CASE WHEN d.size_kat = 6 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 7 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END)+
SUM(CASE WHEN d.size_kat = 8 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3ksb
FROM decal_items a
LEFT JOIN global_buyer b ON b.id = a.buyer
LEFT JOIN global_shape c ON c.id = a.shape
LEFT JOIN decal_ohd d ON d.id_decal_items = a.id
WHERE a.deleted = 0
group by a.nama, a.buyer
order by a.nama, a.buyer