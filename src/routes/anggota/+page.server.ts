import { connection,connectToMySQL } from "../koneksi";

connectToMySQL()
export async function load() {
  
    // Mengambil data anggota dari tabel
    const query = `SELECT * FROM anggota `;
  
    const rows: { [key: string]: any }[] = await new Promise((resolve, reject) => {
      connection.query(query, (error : any, results : any) => {
        if (error) {
          reject(error);
        } else {
          resolve(results);
        }
      });
    });
  
    // Mengembalikan data ke halaman
    return {
      
        anggota: rows,
    
    };
  }

  