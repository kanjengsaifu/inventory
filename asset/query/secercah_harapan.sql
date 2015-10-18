select e.id, 
  e.nama,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1kP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1sP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1bP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2kP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2sP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2bP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3kP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3sP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 3 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3bP,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1kT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1sT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw1 else 0 end) Fokw1bT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2kT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2sT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw2 else 0 end) Fokw2bT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 6 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3kT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 7 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3sT,
  sum(case when p.jenis_decal = 1 and p.size_kat = 8 and p.area = 4 and p.tgli = '2015-10-11'  then p.kw3 else 0 end) Fokw3bT,
  coalesce(s.KW1produksi, 0) KW1produksi,
  coalesce(sum(p.kw1)) + coalesce(s.KW1produksi, 0) BalanceStock
from decal_items e
left join decal_ohd p
  on e.id = p.id_decal_items
left join
(
  select id_decal_items, sum(kw1) KW1produksi
  from decal_phd
  where deleted = 0
  group by id_decal_items
) s
  on e.id = s.id_decal_items
where p.deleted = 0
group by e.id, e.nama, e.buyer