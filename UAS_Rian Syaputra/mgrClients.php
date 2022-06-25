<!DOCTYPE html>
<!--
* Created by PhpStorm.
* User: Houcem
* Date: 24/02/2017
* Time: 12:15
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kendaraan</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/loader.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <?php
        include_once 'templates/navbar.php';
        include_once 'classes/client.class.php';
        $client = new client;
        ?>
        <!-- <button onclick="loadData()">Test</button> -->
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <button class="btn btn-info" data-toggle="modal" data-target="#newClientModal">
                        <i class="fas fa-user-plus"></i>&nbsp; Tambah Data
                    </button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Cari Nama Motor" required>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Motor</th>
                            <th>Tanggal Keluar</th>
                            <th>Tipe Motor</th>
                            <th>Nomor Plat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listClient">                                          
                    </tbody>
                </table>
                <center><div class="loader" style="display:none"></div></center>
            </div>
        </div>
        <!-- The new client modal -->
        <div class="modal fade" id="newClientModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label " for="nom">Nama Pemilik:</label>
                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Nama Pemilik">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="prenom">Merk Motor:</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Merk Motor">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="dateN">Tanggal Keluar:</label>
                        <input type="date" name="dateN" class="form-control" id="dateN" placeholder="Tanggal Keluar">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="adresse">Tipe Kendaraan:</label>
                        <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Tipe Kendaraan">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="tel">No Plat:</label>
                        <input type="tel" name="tel" class="form-control" id="tel" placeholder="No Plat">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" required> Diterima</label>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="btValider" id="btValider" class="btn btn-info">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>

                </div>
            </div>
        </div>
        <!-- Edit client modal -->
        <div class="modal fade" id="editClientModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">                
                    <div class="form-group">
                        <label class="control-label " for="nom">Nama Pemilik:</label>
                        <input type="text" name="nom" class="form-control" id="nomEdit" placeholder="Nama Pemilik">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="prenom">Merk Motor:</label>
                        <input type="text" name="prenom" class="form-control" id="prenomEdit" placeholder="Merk Kendaraan">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="dateN">Tanggal Keluar:</label>
                        <input type="text" name="dateN" class="form-control" id="dateNEdit" placeholder="Tanggal Keluar">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="adresse">Tipe Motor:</label>
                        <input type="text" name="adresse" class="form-control" id="adresseEdit" placeholder="Tipe Motor">
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="tel">No Plat:</label>
                        <input type="text" name="tel" class="form-control" id="telEdit" placeholder="No Plat">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" required> Diterima</label>
                        </div>
                    </div>
                    <input type="text" name="idEdit" id="idEdit" hidden>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="btUpdateClient" id="btUpdateClient" class="btn btn-info">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="scripts/app.js"></script>
</body>
</html>
