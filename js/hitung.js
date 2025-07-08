document.addEventListener('DOMContentLoaded', () => {
    // Harga untuk setiap jenis pelayanan
    const hargaPenginapan = 1000000;
    const hargaTransportasi = 1200000;
    const hargaServisMakan = 500000;

    // Fungsi untuk memformat angka menjadi format Rupiah tanpa simbol mata uang
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    // Fungsi untuk menghitung total harga dan tagihan
    function hitungTagihan() {
        // Mengambil nilai checkbox
        let totalHarga = 0;
        if (document.getElementById('penginapan').checked) {
            totalHarga += hargaPenginapan;
        }
        if (document.getElementById('transportasi').checked) {
            totalHarga += hargaTransportasi;
        }
        if (document.getElementById('servisMakan').checked) {
            totalHarga += hargaServisMakan;
        }

        // Mengambil jumlah peserta
        const jumlahPeserta = parseInt(document.getElementById('jumlahPeserta').value) || 0;

        // Mengambil jumlah hari perjalanan
        const jumlahHari = parseInt(document.getElementById('waktuPelaksanaan').value) || 0;

        // Menghitung total harga paket per hari per peserta
        const hargaPaket = totalHarga;

        // Menghitung jumlah tagihan tanpa diskon
        let jumlahTagihan = jumlahHari * jumlahPeserta * hargaPaket;

        // console.log(jumlahTagihan);

        // Menghitung diskon
        let diskon = 0;

        if (jumlahPeserta >= 5 && jumlahPeserta <= 10) {
            diskon = 0.10; // 10%
        } else if (jumlahPeserta > 10 && jumlahPeserta <= 15) {
            diskon = 0.15; // 15%
        } else if (jumlahPeserta > 15 && jumlahPeserta <= 20) {
            diskon = 0.20; // 20%
        } else if (jumlahPeserta > 20) {
            diskon = 0.25; // 25%
        }

        // Cek diskon spesial
        const semuaPelayanan = document.getElementById('penginapan').checked && 
        document.getElementById('transportasi').checked && 
        document.getElementById('servisMakan').checked;

        if (semuaPelayanan && jumlahPeserta > 40) {
            diskon = 0.35; // 35%
        }

        // Hitung total tagihan setelah diskon
        const jumlahTagihanDiskon = jumlahTagihan * (1 - diskon);

        // Mengisi nilai harga paket dan jumlah tagihan ke form dengan format angka
        document.getElementById('hargaPaket').value = formatRupiah(hargaPaket);
        document.getElementById('jumlahTagihan').value = formatRupiah(jumlahTagihanDiskon);
        // document.getElementById('diskon').value = formatRupiah(diskon * 100) + '%';
    }

    // Menambahkan event listeners untuk perubahan pada elemen input
    document.querySelectorAll('input[type="checkbox"], input[type="number"], input[type="text"]').forEach(element => {
        element.addEventListener('input', hitungTagihan);
    });

    // Validasi Waktu Pelaksanaan
    document.getElementById('waktuPelaksanaan').addEventListener('input', (event) => {
        const input = event.target;
        const errorMessage = document.getElementById('error-message');

        if (input.value < 1) {
            input.value = "";
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });

    // Validasi jumlah Peserta
    document.getElementById('jumlahPeserta').addEventListener('input', (event) => {
        const input = event.target;
        const errorMessage = document.getElementById('error-message-2');

        if (input.value < 1) {
            input.value = "";
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });

    // Validasi No. Hp/Telp
    document.getElementById('noHp').addEventListener('input', (event) => {
        const input = event.target.value;
        const errorMessage = document.getElementById('error-message-noHp');
        const validPattern = /^[0-9+\s()]*$/; // Hanya mengizinkan angka, spasi, +, dan ()

        if (!validPattern.test(input)) {
            errorMessage.style.display = 'block';
            event.target.value = input.replace(/[^0-9+\s()]/g, ''); // Menghapus karakter yang tidak valid
        } else {
            errorMessage.style.display = 'none';
        }
    });

    // Panggil fungsi hitungTagihan saat DOM sudah siap
    hitungTagihan();
});







// document.addEventListener('DOMContentLoaded', () => {
//     // Harga untuk setiap jenis pelayanan
//     const hargaPenginapan = 1000000;
//     const hargaTransportasi = 1200000;
//     const hargaServisMakan = 500000;

//     // Fungsi untuk memformat angka menjadi format Rupiah tanpa simbol mata uang
//     function formatRupiah(angka) {
//         return angka.toLocaleString('id-ID');
//     }

//     // Fungsi untuk menghitung total harga dan tagihan
//     function hitungTagihan() {
//         // Mengambil nilai checkbox
//         let totalHarga = 0;
//         if (document.getElementById('penginapan').checked) {
//             totalHarga += hargaPenginapan;
//         }
//         if (document.getElementById('transportasi').checked) {
//             totalHarga += hargaTransportasi;
//         }
//         if (document.getElementById('servisMakan').checked) {
//             totalHarga += hargaServisMakan;
//         }

//         // Mengambil jumlah peserta
//         const jumlahPeserta = parseInt(document.getElementById('jumlahPeserta').value) || 0;

//         // Mengambil jumlah hari perjalanan
//         const jumlahHari = parseInt(document.getElementById('waktuPelaksanaan').value) || 0;

//         // Menghitung total harga paket per hari per peserta
//         const hargaPaket = totalHarga;

//         // Menghitung jumlah tagihan
//         const jumlahTagihan = jumlahHari * jumlahPeserta * hargaPaket;

//         // Mengisi nilai harga paket dan jumlah tagihan ke form dengan format angka
//         document.getElementById('hargaPaket').value = formatRupiah(hargaPaket);
//         document.getElementById('jumlahTagihan').value = formatRupiah(jumlahTagihan);
//     }

//     // Menambahkan event listeners untuk perubahan pada elemen input
//     document.querySelectorAll('input[type="checkbox"], input[type="number"], input[type="text"]').forEach(element => {
//         element.addEventListener('input', hitungTagihan);
//     });

//     // Validasi Waktu Pelaksanaan
//     document.getElementById('waktuPelaksanaan').addEventListener('input', (event) => {
//         const input = event.target;
//         const errorMessage = document.getElementById('error-message');

//         if (input.value < 1) {
//             input.value = "";
//             errorMessage.style.display = 'block';
//         } else {
//             errorMessage.style.display = 'none';
//         }
//     });

//     // Validasi jumlah Peserta
//     document.getElementById('jumlahPeserta').addEventListener('input', (event) => {
//         const input = event.target;
//         const errorMessage = document.getElementById('error-message-2');

//         if (input.value < 1) {
//             input.value = "";
//             errorMessage.style.display = 'block';
//         } else {
//             errorMessage.style.display = 'none';
//         }
//     });

//     // Validasi No. Hp/Telp
//     document.getElementById('noHp').addEventListener('input', (event) => {
//         const input = event.target.value;
//         const errorMessage = document.getElementById('error-message-noHp');
//         const validPattern = /^[0-9+\s()]*$/; // Hanya mengizinkan angka, spasi, +, dan ()

//         if (!validPattern.test(input)) {
//             errorMessage.style.display = 'block';
//             event.target.value = input.replace(/[^0-9+\s()]/g, ''); // Menghapus karakter yang tidak valid
//         } else {
//             errorMessage.style.display = 'none';
//         }
//     });


//     // Panggil fungsi hitungTagihan saat DOM sudah siap
//     hitungTagihan();
// });