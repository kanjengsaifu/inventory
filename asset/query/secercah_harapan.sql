select e.id, 
  e.nama,
  sum(p.kw1) KW1stokAwal,
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