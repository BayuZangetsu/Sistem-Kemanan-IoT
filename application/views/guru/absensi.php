<script>
if ($('#mapel').val() != null) {
    $('#listsiswa').attr('style', "display=inline");
}
</script>
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800">Absensi</h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card border-left-primary shadow">
            <h5 class="text-primary text-center pt-3">Pilih Kelas</h5>
            <div class="col mr-2">
            <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="kelas">Pilih Tahun Ajaran :</label>
                                <select class="form-control form-control-sm" name="tahun" id="tahun">
                                    <option value="" disabled selected>Pilih tahun...</option>
                                    <option value="1">2020/2021</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Pilih Kelas :</label>
                                <select class="form-control form-control-sm" name="kelas" id="kelas">
                                    <option value="">X IPA 1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Pilih Mapel :</label>
                                <select class="form-control form-control-sm" name="mapel" id="mapel">
                                    <option value="">Matematika</option>
                                    <option value="">IPA</option>
                                    <option value="">Biologi</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- list siswa -->
    <div class="col-lg mb-4 mx-auto" id="listsiswa" style="display:none">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-justify">
                    <div class="col-lg-12 mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Daftar Siswa kelas :
                        </div>
                        <form action="">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" style="width: 5%">No</th>
                                        <th scope="col" style="width: 60%">Nama</th>
                                        <th scope="col" style="width: 35%">Absen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <th>Bayu Setiaji</th>
                                        <th class="text-center">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio1" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Hadir</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio2" value="2">
                                                <label class="form-check-label" for="inlineRadio2">Izin</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio3" value="3">
                                                <label class="form-check-label" for="inlineRadio3">Sakit</label>
                                            </div>
                                            <div class="form-check-inline form-check">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio4" value="4">
                                                <label class="form-check-label" for="inlineRadio4">Alpa</label>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>