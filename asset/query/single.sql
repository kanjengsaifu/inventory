select sum(1.565*((densitas-1000)/1000)*volume) from glasir_thd where id_glasir = 'Y0054'
and tgl_combine between '2015-11-20 18:00:00' and '2015-12-03 18:00:00'