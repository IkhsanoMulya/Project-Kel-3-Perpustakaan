// Mengimpor modul mysql
import * as mysql from 'mysql'; 

// Membuat koneksi ke database
const db = mysql.createConnection({
  host: 'localhost',      // Ganti dengan host database Anda
  user: 'root',       // Ganti dengan username database Anda
  password: '',   // Ganti dengan password database Anda
  database: 'perpustakaan'    // Ganti dengan nama database Anda
});

// Membuka koneksi ke database
function sql(myQuery){
  db.connect((err) => {
    if (err) {
      console.error('Koneksi ke database gagal: ' + err.stack);
      return;
    }
    console.log('Koneksi ke database berhasil, ID koneksi: ' + db.threadId);
   
  });

  db.query(myQuery, (error, results) => {
    if (error) {
      console.error('Error saat menjalankan query: ' + error.stack);
      return;
    }
  
    return results;
  });


}

