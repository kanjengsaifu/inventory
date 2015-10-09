SELECT a.id, a.nama, a.alias,b.nama as buyer, c.dsc as material, d.dsc as forming, e.nama as shape, 
                            f.nama as item, g.dsc as dekorasi, h.nama as size, i.nama as jenis, a.satuan, a.parent
                            FROM decal_items a
                            LEFT JOIN global_buyer b ON b.id  = a.buyer
                            LEFT JOIN global_material c ON c.id  = a.material
                            LEFT JOIN global_forming d ON d.id  = a.forming
                            LEFT JOIN global_shape e ON e.id  = a.shape
                            LEFT JOIN global_items_kategori f ON f.id  = a.item
                            LEFT JOIN global_dekorasi g ON g.id  = a.dekorasi
                            LEFT JOIN global_size h ON h.id  = a.size
                            LEFT JOIN global_jenis_decal i ON i.id  = a.jenis
                            LEFT JOIN global_detail j ON j.id_related = a.id
                            WHERE j.deleted = 0
                            ORDER BY a.id