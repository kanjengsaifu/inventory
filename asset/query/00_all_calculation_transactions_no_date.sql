select a.id, a.nama, x.nama as buyer,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1kP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1sP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1bP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2kP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2sP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2bP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3kP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3sP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3bP,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1kT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1sT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1bT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2kT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2sT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2bT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3kT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3sT,
  sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3bT,
  coalesce(c.Pkw1k, 0) Pkw1k, coalesce(c.Pkw1s, 0) Pkw1s, coalesce(c.Pkw1b, 0) Pkw1b,
  coalesce(c.Pkw2k, 0) Pkw2k, coalesce(c.Pkw2s, 0) Pkw2s, coalesce(c.Pkw2b, 0) Pkw2b,
  coalesce(c.Pkw3k, 0) Pkw3k, coalesce(c.Pkw3s, 0) Pkw3s, coalesce(c.Pkw3b, 0) Pkw3b,
  coalesce(d.Tkw1k, 0) Tkw1k, coalesce(d.Tkw1s, 0) Tkw1s, coalesce(d.Tkw1b, 0) Tkw1b,
  coalesce(d.Tkw2k, 0) Tkw2k, coalesce(d.Tkw2s, 0) Tkw2s, coalesce(d.Tkw2b, 0) Tkw2b,
  coalesce(d.Tkw3k, 0) Tkw3k, coalesce(d.Tkw3s, 0) Tkw3s, coalesce(d.Tkw3b, 0) Tkw3b,
  coalesce(e.Ukw1k, 0) Ukw1k, coalesce(e.Ukw1s, 0) Ukw1s, coalesce(e.Ukw1b, 0) Ukw1b,
  coalesce(e.Ukw2k, 0) Ukw2k, coalesce(e.Ukw2s, 0) Ukw2s, coalesce(e.Ukw2b, 0) Ukw2b,
  coalesce(e.Ukw3k, 0) Ukw3k, coalesce(e.Ukw3s, 0) Ukw3s, coalesce(e.Ukw3b, 0) Ukw3b,
  coalesce(f.Rkw1k, 0) Rkw1k, coalesce(f.Rkw1s, 0) Rkw1s, coalesce(f.Rkw1b, 0) Rkw1b,
  coalesce(f.Rkw2k, 0) Rkw2k, coalesce(f.Rkw2s, 0) Rkw2s, coalesce(f.Rkw2b, 0) Rkw2b,
  coalesce(f.Rkw3k, 0) Rkw3k, coalesce(f.Rkw3s, 0) Rkw3s, coalesce(f.Rkw3b, 0) Rkw3b,
  coalesce(f.RPkw1k, 0) RPkw1k, coalesce(f.RPkw1s, 0) RPkw1s, coalesce(f.RPkw1b, 0) RPkw1b,
  coalesce(f.RPkw2k, 0) RPkw2k, coalesce(f.RPkw2s, 0) RPkw2s, coalesce(f.RPkw2b, 0) RPkw2b,
  coalesce(f.RPkw3k, 0) RPkw3k, coalesce(f.RPkw3s, 0) RPkw3s, coalesce(f.RPkw3b, 0) RPkw3b,
  coalesce(g.Skw1kP, 0) Skw1kP, coalesce(g.Skw1sP, 0) Skw1sP, coalesce(g.Skw1bP, 0) Skw1bP,
  coalesce(g.Skw2kP, 0) Skw2kP, coalesce(g.Skw2sP, 0) Skw2sP, coalesce(g.Skw2bP, 0) Skw2bP,
  coalesce(g.Skw3kP, 0) Skw3kP, coalesce(g.Skw3sP, 0) Skw3sP, coalesce(g.Skw3bP, 0) Skw3bP,
  coalesce(g.Skw1kT, 0) Skw1kT, coalesce(g.Skw1sT, 0) Skw1sT, coalesce(g.Skw1bT, 0) Skw1bT,
  coalesce(g.Skw2kT, 0) Skw2kT, coalesce(g.Skw2sT, 0) Skw2sT, coalesce(g.Skw2bT, 0) Skw2bT,
  coalesce(g.Skw3kT, 0) Skw3kT, coalesce(g.Skw3sT, 0) Skw3sT, coalesce(g.Skw3bT, 0) Skw3bT
from decal_items a
left join global_buyer x on a.buyer = x.id
left join decal_ohd b
  on a.id = b.id_decal_items
left join
(
  select id_decal_items, 
  sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Pkw1k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Pkw1s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Pkw1b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Pkw2k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Pkw2s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Pkw2b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Pkw3k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Pkw3s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Pkw3b
  from decal_phd
  where deleted = 0
  group by id_decal_items
) c on a.id = c.id_decal_items
left join
(
  select id_decal_items, 
  sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Tkw1k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Tkw1s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Tkw1b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Tkw2k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Tkw2s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Tkw2b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Tkw3k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Tkw3s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Tkw3b
  from decal_thd
  where deleted = 0
  group by id_decal_items
) d on a.id = d.id_decal_items
left join
(
  select id_decal_items, 
  sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Ukw1k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Ukw1s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Ukw1b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Ukw2k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Ukw2s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Ukw2b,
  sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Ukw3k,
  sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Ukw3s,
  sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Ukw3b
  from decal_uhd
  where deleted = 0
  group by id_decal_items
) e on a.id = e.id_decal_items
left join
(
  select id_decal_items, 
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Rkw1k,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Rkw1s,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Rkw1b,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Rkw2k,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Rkw2s,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Rkw2b,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Rkw3k,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Rkw3s,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Rkw3b,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) RPkw1k,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) RPkw1s,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) RPkw1b,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) RPkw2k,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) RPkw2s,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) RPkw2b,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) RPkw3k,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) RPkw3s,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) RPkw3b
  from decal_rhd
  where deleted = 0
  group by id_decal_items
) f on a.id = f.id_decal_items
left join
(
  select id_decal_items, 
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Skw1kP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Skw1sP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Skw1bP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Skw2kP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Skw2sP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Skw2bP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Skw3kP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Skw3sP,
  sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Skw3bP,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Skw1kT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Skw1sT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Skw1bT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Skw2kT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Skw2sT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Skw2bT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Skw3kT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Skw3sT,
  sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Skw3bT
  from decal_shd
  where deleted = 0
  group by id_decal_items
) g on a.id = g.id_decal_items
where b.deleted = 0 
group by a.id, a.nama, a.buyer