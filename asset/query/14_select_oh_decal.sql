select a.id_group,d.nama as buyer,f.dsc as dekorasi,a.parent_id,b.nama,a.item_code,c.item,a.isi_motif from decal_ohd a
left join decal_items b on a.parent_id = b.id
left join decal_items_detail c on a.item_code = c.item_code
left join global_buyer d on b.buyer = d.id
left join global_dekorasi f on b.dekorasi =f.id
where a.area = 3 and b.jenis <> 1
order by a.id_group asc