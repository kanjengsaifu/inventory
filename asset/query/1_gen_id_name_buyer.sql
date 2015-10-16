										  SELECT a.id, a.nama,b.nama as buyer
                                FROM decal_items a
                                LEFT JOIN global_buyer b ON b.id = a.buyer
                                WHERE a.deleted = 0
                                group by a.nama, a.buyer
                                order by a.nama, a.buyer