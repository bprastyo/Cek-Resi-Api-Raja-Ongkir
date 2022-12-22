# Cek-Resi-Api-Raja-Ongkir
Aplikasi cek resi menggunakan API Raja Ongkir Pro


Untuk mendapatkan api key raja ongkir silahkan kunjungi situs raja ongkir, daftar akun dan pilih akun pro.


Method	Parameter	
POST/HEAD	key	Ya	String	API Key<br>
POST/HEAD	android-key	Tidak	String	Identitas aplikasi Android<br>
POST/HEAD	ios-key	Tidak	String	Identitas aplikasi iOS<br>
POST	waybill	Ya	String	Nomor resi JNE<br>
POST	courier	Ya	String	Kode kurir: pos, wahana, jnt, sap, sicepat, jet, dse, first, ninja, lion, idl, rex, ide, sentral, anteraja, jtl, star<br>

Untuk Cek resi JNE kemungkinan tidak disupport<br>

Pengisian api key :<br>

cari pada file cek_resi.php<br>
			'key: 2d720xxxxxxxxxxxxxxxxxxxxxxxxxx',<br>
dan masukkan api key yang di dapatkan.
