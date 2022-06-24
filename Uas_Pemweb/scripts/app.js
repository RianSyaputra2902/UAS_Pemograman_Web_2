$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.loader').show();

    loadData();

    // Search in client list
    $('#search').keyup(function(e) {
        var keyWord = $(this).val().toLowerCase();
        $("tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(keyWord) > -1);
        });
    });

});

//load data from DB function
function loadData() {
    var row;
    $.ajax({
        type: "GET",
        url: './api/client.api.php',
        data: {
            mode: 'load',
        },
        dataType: 'json',
        success: function(data) {
            // row = JSON.stringify(data);
            row = data;
        }
    }).done(function() {
        for (let i = 0; i < row.length; i++) {
            let ligne = '<tr>';
            ligne += '<td>' + row[i].id + '</td>';
            ligne += '<td>' + row[i].nomor_plat + '</td>';
            ligne += '<td>' + row[i].merek_kendaraan + '</td>';
            ligne += '<td>' + row[i].tipe_kendaraan + '</td>';
            ligne += '<td>' + row[i].tanggal_keluar + '</td>';
            ligne += '<td>' + row[i].aksi + '</td>';
            ligne += '<td><a href="#" onclick="editClient(' + row[i].id + ')" data-toggle="modal" data-target="#editClientModal" data-toggle="tooltip" data-placement="top" title="Sunting"><i class="fas fa-user-edit"></i></a>&nbsp;';
            ligne += '<a href="#" onclick="deleteClient(' + row[i].id + ')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-user-slash"></i></a></td>';
            ligne += '</tr>';
            $('#listClient').append(ligne);
        }
    })

    $(document).ajaxComplete(function() {
        $('.loader').hide();
    })
}

//Add new karyawan
$('#btValider').click(function() {
    let nomor_plat = $('#nomor_plat').val();
    let merek_kendaraan = $('#merek_kendaraan').val();
    let tipe_kendaraan = $('#tipe_kendaraan').val();
    let tanggal_keluar = $('#tipe_kendaraan').val();
    let aksi = $('#aksi').val();

    $.ajax({
        type: "POST",
        url: './api/client.api.php',
        data: {
            mode: 'insert',
            nomor_plat: nomor_plat,
            merek_kendaraan: merek_kendaraan,
            tipe_kendaraan: tipe_kendaraan,
            tanggal_keluar: tanggal_keluar,
        },
        success: function() {
            swal('Data Berhasil Disimpan', 'perekaman', 'success')
                .then(() => {
                    location.reload();
                });
        }
    });

})

//Edit perekaman data kendaraan
function editClient(id) {
    $('#idEdit').val(id);
    let row;
    $.ajax({
        type: "GET",
        url: "./api/client.api.php",
        data: {
            mode: 'loadOne',
            id: id,
        },
        dataType: 'json',
        success: function(response) {
            row = response;
        }
    }).done(function() {
        $('#nomorEdit').val(row.nomor_plat);
        $('#merekEdit').val(row.merek_kendaraan);
        $('#tipeEdit').val(row.tipe_kendaraan);
        $('#tanggalEdit').val(row.tanggal_keluar);
    });
}

// Update Client
$('#btUpdateClient').click(function() {
    let id = $('#idEdit').val();
    let nomor_plat = $('#nomorEdit').val();
    let merek_kendaraan = $('#merekEdit').val();
    let tipe_kendaraan = $('#tipeEdit').val();
    let tanggal_keluar = $('#tanggalEdit').val();

    $.ajax({
        type: "POST",
        url: './api/client.api.php',
        data: {
            id: id,
            nomor_plat: nomor_plat,
            merek_kendaraan: merek_kendaraan,
            tipe_kendaraan: tipe_kendaraan,
            tanggal_keluar: tanggal_keluar,
            mode: 'update',
        },
        success: function() {
            swal('Edit perekaman', 'Pembaruan berhasil diselesaikan', 'berhasil')
                .then(() => {
                    location.reload();
                });
        }
    });

})

// Delete Client
function deleteClient(id) {
    swal({
            title: "Apa Anda Yakin ?",
            text: "Anda akan menghapus perekaman !",
            icon: "warning",
            buttons: ["Batal", "Konfirmasi"],
        })
        .then((willCancel) => {
            if (willCancel) {
                $.ajax({
                    type: "POST",
                    url: "./api/client.api.php",
                    data: {
                        mode: 'delete',
                        id: id,
                    },
                    success: function() {
                        swal('Dihapus !', 'Akun perekaman berhasil dihapus', 'berhasil')
                            .then(() => {
                                location.reload();
                            });
                    },
                })
            } else {
                swal("Akun perekaman belum dihapus");
            }
        });
}