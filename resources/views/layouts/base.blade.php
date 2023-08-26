<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>


    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />

</head>

<body>

    @include('layouts.sidebar')
    @yield('content')

    @include('layouts.footer')
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>

    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        function loadChartData() {
            const pemasukanElem = document.getElementById('pemasukan');
            const pengeluaranElem = document.getElementById('pengeluaran');
            const penggajianElem = document.getElementById('penggajian');
            const labaBersihElem = document.getElementById('laba_bersih');
            fetch('/getDataAll') // Ganti dengan URL endpoint yang sesuai
        .then(response => response.json())
            .then(data => {
                // Tampilkan hasil perhitungan di elemen HTML
                const pemasukanValue = data.pemasukan !== null ? data.pemasukan : 0;
                const pengeluaranValue = data.pengeluaran !== null ? data.pengeluaran : 0;
                const penggajianValue = data.penggajian !== null ? data.penggajian : 0;
                const labaBersihValue = data.laba_bersih !== null ? data.laba_bersih : 0;

                const pemasukanFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pemasukanValue);
                const pengeluaranFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pengeluaranValue);
                const penggajianFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(penggajianValue);
                const labaBersihFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(labaBersihValue);

                // Tampilkan hasil perhitungan di elemen HTML
                pemasukanElem.textContent =   pemasukanFormatted;
                pengeluaranElem.textContent =  pengeluaranFormatted;
                penggajianElem.textContent =  penggajianFormatted;
                labaBersihElem.textContent =  labaBersihFormatted;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        tahunSelect.addEventListener('change', function () {
    const tahunTerpilih = tahunSelect.value;
    const pemasukanElem = document.getElementById('pemasukan');
        const pengeluaranElem = document.getElementById('pengeluaran');
        const penggajianElem = document.getElementById('penggajian');
        const labaBersihElem = document.getElementById('laba_bersih');
    
    if (tahunTerpilih === '') {
        // Menggunakan Ajax untuk mengambil data dari server jika tahun tidak dipilih   
        fetch('/getDataAll') // Ganti dengan URL endpoint yang sesuai
        .then(response => response.json())
            .then(data => {
                // Tampilkan hasil perhitungan di elemen HTML
                const pemasukanValue = data.pemasukan !== null ? data.pemasukan : 0;
                const pengeluaranValue = data.pengeluaran !== null ? data.pengeluaran : 0;
                const penggajianValue = data.penggajian !== null ? data.penggajian : 0;
                const labaBersihValue = data.laba_bersih !== null ? data.laba_bersih : 0;

                const pemasukanFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pemasukanValue);
                const pengeluaranFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pengeluaranValue);
                const penggajianFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(penggajianValue);
                const labaBersihFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(labaBersihValue);

                // Tampilkan hasil perhitungan di elemen HTML
                pemasukanElem.textContent =   pemasukanFormatted;
                pengeluaranElem.textContent =  pengeluaranFormatted;
                penggajianElem.textContent =  penggajianFormatted;
                labaBersihElem.textContent =  labaBersihFormatted;
            })
            .catch(error => console.error('Error:', error));
    } else {
        // Menggunakan Ajax untuk mengambil data dari server jika tahun dipilih

        fetch('/getDataByYear/' + tahunTerpilih) // Ganti dengan URL endpoint yang sesuai
            .then(response => response.json())
            .then(data => {
                const pemasukanValue = data.pemasukan !== null ? data.pemasukan : 0;
                const pengeluaranValue = data.pengeluaran !== null ? data.pengeluaran : 0;
                const penggajianValue = data.penggajian !== null ? data.penggajian : 0;
                const labaBersihValue = data.laba_bersih !== null ? data.laba_bersih : 0;

                const pemasukanFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pemasukanValue);
                const pengeluaranFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(pengeluaranValue);
                const penggajianFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(penggajianValue);
                const labaBersihFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(labaBersihValue);

                // Tampilkan hasil perhitungan di elemen HTML
                pemasukanElem.textContent =   pemasukanFormatted;
                pengeluaranElem.textContent =  pengeluaranFormatted;
                penggajianElem.textContent = penggajianFormatted;
                labaBersihElem.textContent =  labaBersihFormatted;

            })
            .catch(error => console.error('Error:', error));
    }
});
loadChartData()
    </script>

</body>

</html>