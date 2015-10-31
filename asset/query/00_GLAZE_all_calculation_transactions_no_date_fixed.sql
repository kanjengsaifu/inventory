select a.id_glasir, a.nama_glasir,
                                REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as sab, 
                                REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as sas,
                                REPLACE(FORMAT((COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0)+
                                COALESCE(sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0)),2),',','')as gtot,
                          coalesce(c.turun_bgps, 0) turun_bgps, coalesce(d.ditarik_supply, 0) ditarik_supply, coalesce(e.return_prod, 0) return_prod, coalesce(f.kirim_prod, 0) kirim_prod,

                                REPLACE(FORMAT((coalesce(c.turun_bgps, 0)+sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END)) - coalesce(d.ditarik_supply, 0),2),',','') stok_bgps,
                                REPLACE(FORMAT(((coalesce(d.ditarik_supply, 0) + coalesce(e.return_prod, 0))+sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END)) - coalesce(f.kirim_prod, 0),2),',','') stok_supply,
                                
                                 REPLACE(FORMAT((GREATEST((coalesce(c.turun_bgps, 0)+sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END)) - coalesce(d.ditarik_supply, 0),',','')+
                                GREATEST(((coalesce(d.ditarik_supply, 0) + coalesce(e.return_prod, 0))+sum(CASE WHEN b.area=3 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = 1 THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END)) - coalesce(f.kirim_prod, 0),',','')),2),',','') total
                                
                        from glasir a
                        left join glasir_ohd b
                          on a.id_glasir = b.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') turun_bgps
                          from glasir_phd
                          where deleted = 0
                          group by id_glasir
                        ) c on a.id_glasir = c.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') ditarik_supply
                          from glasir_phd_sp
                          where deleted = 0
                          group by id_glasir
                        ) d on a.id_glasir = d.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') return_prod
                          from glasir_rhd
                          where deleted = 0
                          group by id_glasir
                        ) e on a.id_glasir = e.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') kirim_prod
                          from glasir_thd
                          where deleted = 0
                          group by id_glasir
                        ) f on a.id_glasir = f.id_glasir
                        where b.deleted = 0 
                        group by a.id_glasir