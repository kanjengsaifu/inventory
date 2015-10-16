										  SELECT a.id, a.nama,b.nama as buyer, 
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1bT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2bT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3bT
                                FROM decal_items a
                                LEFT JOIN global_buyer b ON b.id = a.buyer
                                LEFT JOIN decal_ohd d ON d.id_decal_items = a.id
                                WHERE a.deleted = 0
                                group by a.nama, a.buyer
                                order by a.nama, a.buyer