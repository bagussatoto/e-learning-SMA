<?php
include './db.php';  
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<title>dashboard</title>
	<style>
		#menu-toggle:checked + #menu {
			display: block;
		}
	</style>
</head>
<body class="antialiased bg-gray-200">
    <header class="lg:px-16 px-4 bg-gray-400 flex shadow-md flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-between items-center">
            <a href="index.html" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
                <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400" src="../public/foto/logo-musaba.JPG" alt="logo smk">
                <p class ="lg:p-4 py-2 "><b>SMK MUHAMMADIYAH 1 BANTUL</b></p>
              </a>
        </div>
        <label for="menu-toggle" class="pointer-cursor lg:hidden block">
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
    
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                    <a href="logout.php" class="lg:p-4 py-1 border-b-1 bg-red-600 text-white p-1 rounded">Logout</a>
                </ul>
            </nav>        
        </div>
    </header>

    <div id="Message" class="bg-yellow-300 rounded-lg shadow-md text-center overflow-hidden px-5 mx-4 py-3 ">
        <p>selamat datang kembali, <?php echo $user['username']; ?></p>    
    </div> 
    <div class="container mx-auto px-4 py-10">
        <?php if ($role == 'admin'): ?>
            <a href="./admin/admin.php" class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">edit semua user</a>
        <?php elseif ($role == 'guru'): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <a href="./dashboard_guru/kehadiranSiswa.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
            <img src="foto/absensi.jpg" alt="Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Absensi</h3>
                <p class="text-gray-700 text-base">cek absensi kehadiran siswa siswi</p>
            </div>
        </a>
        <!-- Card 2 -->
        <a href="./dashboard_guru/tugas_siswa.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
            <img src="foto/jadwal.jpg" alt="Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Tugas</h3>
                <p class="text-gray-700 text-base">Tugas pelajaran siswa dan siswi</p>
            </div>
        </a>
        <!-- Card 3 -->
        <a href="./dashboard_guru/materi.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
            <img src="foto/materi.jpg" alt="Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Materi</h3>
                <p class="text-gray-700 text-base">Materi siswa siswi</p>
            </div>
        </a>
        </a>
    </div>
        <?php elseif ($role == 'siswa'): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <a href="./siswa/home.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="foto/absensi.jpg" alt="Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">Absensi</h3>
                            <p class="text-gray-700 text-base">presensi mahasiswa SMK MUHAMMADIYAH 1 BANTUL</p>
                        </div>
                    </a>
                    <!-- Card 2 -->
                    <a href="./jadwal/schedules.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="foto/jadwal.jpg" alt="Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">Jadwal</h3>
                            <p class="text-gray-700 text-base">jadwal pelajaran siswa dan siswi SMK MUHAMMADIYAH 1 BANTUL</p>
                        </div>
                    </a>
                    <!-- Card 3 -->
                    <a href="./materi/materi.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="foto/materi.jpg" alt="Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">Materi</h3>
                            <p class="text-gray-700 text-base">Materi akses disini</p>
                        </div>
                    </a>
                    <!-- Card 4 -->
                    <a href="./tugas/tugas.php" class="block bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="foto/tugas.jpg" alt="Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">Tugas</h3>
                            <p class="text-gray-700 text-base">Tugas wajib dikerjakan</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif; ?>

<footer class="bg-white my-4 rounded-lg">
    <div class="mx-auto w-full max-w-screen-xl p-3 py-6 lg:py-8">
    <div class="flex justify-center items-center">
    <a href="#" class="flex items-center">
        <img src="../public/foto/logo-musaba.JPG" class="h-8 me-3" alt="logoSMK" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-black">SMK MUHAMMADIYAH 1 BANTUL</span>
    </a>
</div>

            <div class="grid grid-cols-3 gap-0 sm:gap-5 sm:grid-cols-3 my-8">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Ikuti kami</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <div class="row justify-content-start">
                        <a href="https://smkmuh1bantul.sch.id" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-briefcase"></i> https://smkmuh1bantul.sch.id 
                        </a>
                        <a href="https://lms.smkmuh1bantul.sch.id/" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-rss-square"></i> https://lms.smkmuh1bantul.sch.id/
                        </a>
                        <a href="https://www.instagram.com/smkmusaba/" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-instagram"></i> @smkmusaba
                        </a>
                        <a href="https://web.facebook.com/smkmusaba" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-facebook-square"></i> @smkmusaba
                        </a>
                        <a href="https://www.youtube.com/channel/UCfwnlEtnJvQQA6oMk8pcLUA" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-youtube"></i> SMK MUSABA
                        </a>
                        <a href="https://wa.me/6285943542304" class="block mb-3 text-lg" type="button" id="btncari">
                            <i class="fa fa-whatsapp"></i> 085943542304
                        </a>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Alamat</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <p>Jl. Parangtritis Km 12 Manding, Kabupaten Bantul, Yogyakarta</p>
                        <p>(0274) 367954</p>
                        <!-- <p><a href="#" class="underline">index@gmail.com</a></p> -->
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">About</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4"><a href="#" class="hover:underline">
                        SMK Muhammadiyah 1 Bantul adalah sebuah sekolah menengah kejuruan (SMK) swasta yang didirikan pada tahun 1970 dan masih menggunakan program kurikulum belajar SMK 2013.
                        Sekolah ini menawarkan berbagai jurusan yang disesuaikan dengan kebutuhan industri dan masyarakat, serta menyediakan berbagai kegiatan ekstrakurikuler seperti karate, basket, futsal, dan grup belajar.
                        </a></li>
                        <li><a href="#" class="hover:underline"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="#" class="hover:underline font-bold">SMK MUSABA</a>. All Rights Reserved.</span>
            <div class="flex mt-4 sm:justify-center sm:mt-0">

                <!-- <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Facebook page</span>
                </a>
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                        <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Twitter page</span>
                </a>           
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.733 2.926A8.663 8.663 0 0 1 18.7 10a8.653 8.653 0 0 1-5.155 7.867A8.528 8.528 0 0 1 10 19a8.538 8.538 0 0 1-3.545-.758 8.668 8.668 0 0 1-2.926-1.733A8.5 8.5 0 0 1 1.3 10a8.654 8.654 0 0 1 .342-2.46A8.52 8.52 0 0 1 3.375 4.615 8.625 8.625 0 0 1 7.134 2.14 8.568 8.568 0 0 1 10 1.3a8.61 8.61 0 0 1 2.46.342 8.512 8.512 0 0 1 4.153 2.972Zm-9.345 4.972 1.44 5.376a6.684 6.684 0 0 1-.635-.23 6.618 6.618 0 0 1-2.2-1.448 6.582 6.582 0 0 1-1.453-2.2 6.726 6.726 0 0 1-.23-.636l5.376 1.44ZM8.616 9.175 10 10.559l3.627-3.627a.939.939 0 0 1 1.333 0 .939.939 0 0 1 0 1.333L11.333 11.89l1.392 1.392c.238.238.293.6.128.88a.92.92 0 0 1-.858.508L7.76 12.23a.938.938 0 0 1-.708-.708L5.213 7.872a.924.924 0 0 1 1.387-1.009Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Instagram page</span>
                </a>
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm4.195 6.195A6.679 6.679 0 0 0 10 4.6a6.679 6.679 0 0 0-4.195 1.6A6.679 6.679 0 0 0 4.6 10a6.68 6.68 0 0 0 1.6 4.195A6.68 6.68 0 0 0 10 15.8a6.68 6.68 0 0 0 4.195-1.6A6.679 6.679 0 0 0 15.8 10a6.679 6.679 0 0 0-1.605-3.805Zm-8.283 8.283a7.978 7.978 0 0 1-1.21-1.21l2.312-.618-.472-.472-.619 2.312a7.978 7.978 0 0 1-1.21-1.21Zm1.894 1.046 3.823-1.023-2.8-2.8-1.023 3.823Zm7.194-3.46-2.311.619.472.472.619-2.312a7.978 7.978 0 0 1 1.21 1.21ZM11.853 8.2a.943.943 0 0 1-.267-.628.905.905 0 0 1 .267-.627.905.905 0 0 1 1.255 0 .905.905 0 0 1 0 1.255.913.913 0 0 1-.628.267.943.943 0 0 1-.628-.267ZM10 0a10 10 0 0 0-6.32 17.684A10 10 0 0 1 17.684 3.68 9.931 9.931 0 0 0 10 0Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">LinkedIn page</span>
                </a> -->

            </div>
        </div>
    </div>
</footer>


</body>
</html>
