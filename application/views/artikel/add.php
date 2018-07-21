<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>

  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Mobil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('artikel/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="merk">Judul Artikel</label>
                  <input type="text" name="judul_artikel" id="type" class="form-control" placeholder="Judul Artikel" value="<?php echo set_value('judul_artikel'); ?>">
                </div>

                <div class="form-group">
                  <label for="merk">Isi Artikel</label>
                  <textarea class="form-control" rows="5" id="comment" name="isi_artikel"  placeholder="Isi Artikel" value="<?php echo set_value('isi_artikel'); ?>"></textarea>
                  <!-- <input type="text-area" name="isi_artikel" id="type" class="form-control" placeholder="Isi Artikel" value="<?php echo set_value('isi_artikel'); ?>"> -->
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Foto Artikel</label>
                  <input type="file" id="foto" name="gambar_artikel">
                </div>

                <div class="form-group">
                  <label for="merk">Author</label>
                  <input type="text" name="author" id="type" class="form-control" placeholder="Author" value="<?php echo set_value('author'); ?>">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->

          <!-- /.box -->


          <!-- /.box -->

          <!-- Input addon -->

          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->

        <!--/.col (right) -->
      </div>
