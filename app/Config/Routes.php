<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Default login
// $routes->get('/', 'Home::index');

// // $routes->get('/', 'login::login');
// $routes->get('login', 'Login::login');

// $routes->post('login/login_action', 'login::login_action');
// Rute utama
$routes->get('/', 'Home::index'); // Halaman depan

// Rute login
$routes->get('login', 'Login::login'); // Halaman login
$routes->post('login/login_action', 'Login::login_action'); // Aksi login

// Rute logout
$routes->get('logout', 'Login::logout'); // Logout, arahkan ke home setelah logout


// Admin routes with auth filter
$routes->get('admin/dashboard', 'Admin::dashboard', ['filter' => 'auth:admin']);
$routes->get('admin/statik', 'Admin::statik', ['filter' => 'auth:admin']);
$routes->get('admin/jenisdoc', 'Admin::jenisdoc', ['filter' => 'auth:admin']);
$routes->get('admin/profile', 'Admin::profile', ['filter' => 'auth:admin']);
$routes->post('admin/updateProfileImage', 'Admin::updateProfileImage', ['filter' => 'auth:admin']);

// Dami data
$routes->get('admin/tabel', 'Admin::tabel', ['filter' => 'auth:admin']);
$routes->get('admin/tambahdoc', 'Admin::tambahdoc', ['filter' => 'auth:admin']);
$routes->get('admin/editdoc/(:num)', 'Admin::editdoc/$1', ['filter' => 'auth:admin']);
$routes->post('admin/updatedoc/(:num)', 'Admin::updatedoc/$1', ['filter' => 'auth:admin']);
$routes->get('admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'auth:admin']);

// --------------------------
// Jenis Dokumen
$routes->get('admin/tambahjenis', 'Admin::tambahjenis', ['filter' => 'auth:admin']);
$routes->post('admin/simpanjenis', 'Admin::simpanjenis', ['filter' => 'auth:admin']);
$routes->get('admin/editjenis/(:num)', 'Admin::editjenis/$1', ['filter' => 'auth:admin']);
$routes->post('admin/updatejenis/(:num)', 'Admin::updatejenis/$1', ['filter' => 'auth:admin']);
$routes->get('admin/hapusjenis/(:num)', 'Admin::hapusjenis/$1', ['filter' => 'auth:admin']);

// --------------------------
// Kategori Dokumen
$routes->get('/admin/tambahkategori', 'Admin::tambahKategori', ['filter' => 'auth:admin']);
$routes->post('/admin/simpankategori', 'Admin::simpanKategori', ['filter' => 'auth:admin']);
$routes->get('admin/editkategori/(:num)', 'Admin::editkategori/$1', ['filter' => 'auth:admin']);
$routes->post('admin/updatekategori/(:num)', 'Admin::updatekategori/$1', ['filter' => 'auth:admin']);
$routes->get('admin/hapuskategori/(:num)', 'Admin::hapuskategori/$1', ['filter' => 'auth:admin']);

// --------------------------
// Lihat Dokumen
$routes->get('admin/lihatdoc/(:num)', 'Admin::lihatdoc/$1', ['filter' => 'auth:admin']);
$routes->get('fileArsip/(:any)', 'Files::serveFile/$1');

// --------------------------
// User Management
$routes->get('/admin/tambahuser', 'Admin::tambahuser', ['filter' => 'auth:admin']);
$routes->post('/admin/simpanuser', 'Admin::simpanuser', ['filter' => 'auth:admin']);
$routes->get('admin/ubahdatadiri', 'Admin::ubahdatadiri', ['filter' => 'auth:admin']);
$routes->post('/admin/simpanubahdatadiri', 'Admin::simpanubahdatadiri', ['filter' => 'auth:admin']);
$routes->get('admin/edituser/(:num)', 'Admin::edituser/$1', ['filter' => 'auth:admin']);
$routes->post('admin/updateuser/(:num)', 'Admin::updateuser/$1', ['filter' => 'auth:admin']);
$routes->get('admin/deleteuser/(:num)', 'Admin::deleteuser/$1', ['filter' => 'auth:admin']);

// Logout
$routes->get('login/logout', 'Login::logout');

// Other routes
$routes->post('admin/simpandoc', 'Admin::simpandoc',['filter' => 'auth:admin']);
$routes->get('admin/das', 'Admin::das');

// Pegawai routes with auth filter
 // Pegawai routes with role filter
//  $routes->get('pegawai/dashboard', 'Pegawai::dashboard', ['filter' => 'role:user']);
//  $routes->get('pegawai/profile', 'Pegawai::profile', ['filter' => 'role:user']);
$routes->get('pegawai/dashboard', 'pegawai::dashboard', ['filter' => 'role:user']);
$routes->get('pegawai/statik', 'pegawai::statik', ['filter' => 'role:user']);
$routes->get('pegawai/jenisdoc', 'pegawai::jenisdoc', ['filter' => 'role:user']);
$routes->get('pegawai/profile', 'pegawai::profile', ['filter' => 'role:user']);
$routes->post('pegawai/updateProfileImage', 'pegawai::updateProfileImage', ['filter' => 'role:user']);

// Dami data
$routes->get('pegawai/tabel', 'pegawai::tabel', ['filter' => 'role:user']);
$routes->get('pegawai/tambahdoc', 'pegawai::tambahdoc', ['filter' => 'role:user']);
$routes->get('pegawai/editdoc/(:num)', 'pegawai::editdoc/$1', ['filter' => 'role:user']);
$routes->post('pegawai/updatedoc/(:num)', 'pegawai::updatedoc/$1', ['filter' => 'role:user']);
$routes->get('pegawai/delete/(:num)', 'pegawai::delete/$1', ['filter' => 'role:user']);
$routes->post('pegawai/simpandoc', 'pegawai::simpandoc', ['filter' => 'role:user']);

// --------------------------
// Jenis Dokumen
$routes->get('pegawai/tambahjenis', 'pegawai::tambahjenis', ['filter' => 'role:user']);
$routes->post('pegawai/simpanjenis', 'pegawai::simpanjenis', ['filter' => 'role:user']);
$routes->get('pegawai/editjenis/(:num)', 'pegawai::editjenis/$1', ['filter' => 'role:user']);
$routes->post('pegawai/updatejenis/(:num)', 'pegawai::updatejenis/$1', ['filter' => 'role:user']);
$routes->get('pegawai/hapusjenis/(:num)', 'pegawai::hapusjenis/$1', ['filter' => 'role:user']);

// --------------------------
// Kategori Dokumen
$routes->get('/pegawai/tambahkategori', 'pegawai::tambahKategori', ['filter' => 'role:user']);
$routes->post('/pegawai/simpankategori', 'pegawai::simpanKategori', ['filter' => 'role:user']);
$routes->get('pegawai/editkategori/(:num)', 'pegawai::editkategori/$1', ['filter' => 'role:user']);
$routes->post('pegawai/updatekategori/(:num)', 'pegawai::updatekategori/$1', ['filter' => 'role:user']);
$routes->get('pegawai/hapuskategori/(:num)', 'pegawai::hapuskategori/$1', ['filter' => 'role:user']);

// --------------------------
// Lihat Dokumen
$routes->get('pegawai/lihatdoc/(:num)', 'pegawai::lihatdoc/$1', ['filter' => 'role:user']);
$routes->get('fileArsip/(:any)', 'Files::serveFile/$1');

// --------------------------
// User Management
$routes->get('/pegawai/tambahuser', 'pegawai::tambahuser', ['filter' => 'role:user']);
$routes->post('/pegawai/simpanuser', 'pegawai::simpanuser', ['filter' => 'role:user']);
$routes->get('pegawai/ubahdatadiri', 'pegawai::ubahdatadiri', ['filter' => 'role:user']);
$routes->post('/pegawai/simpanubahdatadiri', 'pegawai::simpanubahdatadiri', ['filter' => 'role:user']);
$routes->get('pegawai/edituser/(:num)', 'pegawai::edituser/$1', ['filter' => 'role:user']);
$routes->post('pegawai/updateuser/(:num)', 'pegawai::updateuser/$1', ['filter' => 'role:user']);
$routes->get('pegawai/deleteuser/(:num)', 'pegawai::deleteuser/$1', ['filter' => 'role:user']);

 
