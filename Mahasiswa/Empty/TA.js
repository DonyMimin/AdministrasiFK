// Mendapatkan referensi elemen form
var form = document.getElementById('myForm');
let inputAkhir = document.getElementById('Akhir');
let inputPublikasi = document.getElementById('Publikasi');
let inputEmail = document.getElementById('Email');
let email =  "@stu.untar.ac.id";

function Check(event) {
    event.preventDefault(); // Prevent form submission
  
    console.log('tombol register berhasil di klik');
    console.log(inputAkhir.value);
    console.log(inputPublikasi.value);
    console.log(inputEmail.value);
  
    if (inputAkhir.value === inputPublikasi.value) {
      alert('Judul Tugas Akhir dan Judul Artikel Publikasi tidak boleh sama!');
    } else if (!inputEmail.value.endsWith(email)) {
      alert('Email harus berupa @stu.untar.ac.id');
    } else {
      // Redirect to the next page
      window.location.href = 'Kuesioner.html';
    }
  }
  
  form.addEventListener('submit', Check);