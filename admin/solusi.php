<?php
require_once '../controller/solusiController.php';

$solusi = query("SELECT * FROM solusi");
$kategori = query("SELECT * FROM tingkattekanan_stres");

if (isset($_POST["submit_solusi"])) {
  if (input_solusi($_POST) > 0) {
    echo "
        <script>
        alert('Data Berhasil Ditambah');
        document.location.href='solusi.php';
        </script>
        ";
  } else {
    echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='solusi.php';
        </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SIPATITESA</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/Logo4.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php
    require_once '../sidebar/sidebar_admin.php';
    ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item">
                <a class="nav-link text-primary active" href="profil.php"> My Profile</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title fw-semibold mb-4">Solusi</h1>
            <div class="container mt-3">
              <button type="button" class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#myModal">
                + Input Solusi
              </button>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Input Solusi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <form method="post" action="">
                    <!-- Modal body -->
                    <div class="modal-body">
                      <label for="kategori">Tingkat Tekanan Stres</label>
                      <select class="form-select" id="kategori" aria-label="Default select example" name="idkategori">
                        <option selected hidden value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k): ?>
                          <option value="<?= $k['idtekanan']; ?>"><?= $k['tekanan']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <br>
                      <label for="solusi">Solusi :</label>
                      <textarea class="form-control" rows="2" id="solusi" name="solusi"></textarea>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">

                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" name="submit_solusi" class="btn btn-primary" data-bs-dismi
                        ss="modal">Kirim</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>



            <table class="table">
              <thead>
                <tr class="table-primary">
                  <th>Kategori</th>
                  <th>Solusi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($solusi as $s): ?>
                  <tr>
                    <?php
                    $idkategori = $s['idtekanan'];
                    $tekanan = query("SELECT tekanan FROM tingkattekanan_stres WHERE idtekanan = $idkategori")[0];
                    ?>
                    <td>
                      <?= $tekanan['tekanan']; ?>
                    </td>
                    <td>
                      <?= $s['solusi']; ?>
                    </td>
                    <td>
                      <a style="text-decoration: none;" href="editsolusi.php?id=<?= $s['idsolusi']; ?>">
                        <i class="ti ti-pencil fs-6"></i>
                      </a>
                      |
                      <a style="text-decoration: none;" href="delete_solusi.php?idsolusi=<?= $s['idsolusi']; ?>"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                        <i class="ti ti-trash fs-6"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="text-center text-black fw-bold lebar">
    <p class="mb-0 fs-3">&copy; <a href="#" target="_blank"
        class="pe-1 text-primary text-decoration">Maharanigilangpratiwi</a>2023</p>
  </footer>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>