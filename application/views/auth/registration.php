  <div class="container">
      <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                  <div class="col-lg">
                      <div class="p-5">
                          <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                          </div>
                          <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" id="name"
                                      placeholder="Masukan Nama Kamu" name="name" value="<?= set_value('name'); ?>">
                                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" id="email"
                                      placeholder="guru@example.com" name="email" value="<?= set_value('email'); ?>">
                                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="password" class="form-control form-control-user" id="password1"
                                          name="password1" value="<?= set_value('password1'); ?>"
                                          placeholder="masukan password">
                                      <?= form_error('password1', '<small class="text-danger pl-4">', '</small>'); ?>
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="password" class="form-control form-control-user" id="password2"
                                          name="password2" value="<?= set_value('password2'); ?>"
                                          placeholder="Repeat Password">
                                      <?= form_error('password2', '<small class="text-danger pl-4">', '</small>'); ?>
                                  </div>
                              </div>
                              <center>
                                  <label for="status_akun">Pilih Jabatan Anda</label>
                              </center>
                              <div class="form-group">
                                  <select class="form-control" name="status_akun" id="status_akun">
                                      <option value="2">Guru</option>
                                      <option value="3">TU</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary btn-user btn-block">
                                  Register Account
                              </button>
                          </form>
                          <hr>
                          <div class="text-center">
                              <a class="small" href="forgot-password.html">Forgot Password?</a>
                          </div>
                          <div class="text-center">
                              <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </ div>
      </div>
