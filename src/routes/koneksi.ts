import mysql from 'mysql';

// Buat koneksi ke MySQL
const connection = mysql.createConnection({
  host: 'localhost', // Ganti dengan host MySQL Anda
  user: 'root', // Ganti dengan username MySQL Anda
  password: '', // Ganti dengan password MySQL Anda
  database: 'perpustakaan' // Ganti dengan nama database yang ingin Anda akses
});

// Fungsi untuk menghubungkan ke MySQL
const connectToMySQL = () => {
  connection.connect((err :any) => {
    if (err) {
      console.error('Error connecting to MySQL: ', err);
      return;
    }
    console.log('Connected to MySQL!');
  });
};

// Ekspor koneksi MySQL
export { connection, connectToMySQL };
