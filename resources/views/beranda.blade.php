@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card-header bg-transparent">
                <h1 class="fw-heading">SMP Al-Azhar Syifa Budi: Learn Anywhere, Achieve Everywhere!</h1>
            </div>
            <div class="card-body">
                <p class="text-justify">
                    SMP Al Azhar Syifa Budi adalah sekolah menengah pertama yang berkomitmen pada pendidikan berkualitas
                    dengan mengintegrasikan nilai-nilai Islam dalam kurikulum nasional.
                </p>
                <p class="text-justify">
                    SMP Al Azhar Syifa Budi menawarkan lingkungan belajar yang kondusif dengan fasilitas modern dan
                    tenaga pengajar profesional yang berdedikasi tinggi. SMP Al Azhar Syifa Budi tidak hanya fokus pada
                    pengembangan akademik siswa, tetapi juga pada pembentukan karakter yang islami, sehingga siswa dapat
                    tumbuh menjadi individu yang berakhlak mulia, berpengetahuan luas, dan siap menghadapi tantangan
                    global.
                </p>

                <p class="fw-bold">Peta Lokasi: </p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.973899696382!2d106.48163!3d-6.198438!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4201034b04722d%3A0x72cebc03b66dd6de!2sAl-Azhar%20Syifa%20Budi%20Talaga%20Bestari!5e0!3m2!1sid!2sid!4v1719371835986!5m2!1sid!2sid"
                    width="700" height="290" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="col-md-5">
            <aside class="d-flex justify-content-center flex-column">
                <img src="{{ asset('img/landing.png') }}" alt="landing" width="430px" class="mb-3 mx-auto">
                <strong>Alamat :</strong>
                <ul class="list-unstyled">
                    <li>
                        Perumahan Talaga Bestari, Jl. Jungle Boulevard No.1, Cibadak, Kec. Cikupa, Kabupaten Tangerang,
                        Banten 15710
                    </li>
                </ul>

                <strong>Kontak :</strong>
                <ul>
                    <li>Telepon: (021) 123-4567</li>
                    <li>Email: info@alazharsyifabudi.sch.id</li>
                    <li>Website: www.alazharsyifabudi.sch.id</li>
                </ul>

                <strong>Jam Operasional :</strong>
                <ul>
                    <li>Senin - Jumat : 08.00 - 16.00 WIB</li>
                    <li>Sabtu - Minggu : Tutup</li>
                </ul>

                <div class="d-flex justify-content-lg-around">
                    <div class="instagram d-flex align-items-center">
                        <img src="{{asset('img/ig.png')}}" alt="icon-ig">
                        <a href="" class="text-decoration-none text-dark ms-1">alazharsyifabudi</a>
                    </div>
                    <div class="facebook d-flex align-items-center">
                        <img src="{{asset('img/fb.png')}}" alt="icon-fb">
                        <a href="" class="text-decoration-none text-dark ms-1">al-azharsyifabudi</a>
                    </div>
                    <div class="youtube d-flex align-items-center">
                        <img src="{{asset('img/yt.png')}}" alt="icon-yt">
                        <a href="" class="text-decoration-none text-dark ms-1">alazhar_syifabudi</a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>
@endsection