select a.idphdh,a.noprod,a.idglasir,a.idphd,b.nama_gps,a.tgl,a.volume,a.densitas,
a.jns,a.kms,c.nama_bm,d.nama_tong,a.petugas,a.inp,a.inp_time from glasir_phdh a
join glasir_patt b on a.idgps = b.idgps join global_mesin c on a.idbm = c.id_bm 
join global_tong d on a.idtong = d.id_tong
where noprod = 'PG00001' and idglasir = 'Y00001' and idphd ='1'
					   