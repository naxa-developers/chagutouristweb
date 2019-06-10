<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                <header class="panel-heading">Ready Section</header>
                    <form role="form"  method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo !empty($drrdataeditdata[0]['id'])?$drrdataeditdata[0]['id']:'' ?>">
                        <div class="form-group ">
                            <div class="col-sm-6">
                              <label for="name">Image Title :</label>
                              <input type="text" name="name" class="form-control" id="name" value="<?php echo !empty($drrdataeditdata[0]['name'])?$drrdataeditdata[0]['name']:'' ?>" placeholder="ENTER IMAGE TITLE">
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="bannerImg1">Image </label>
                                <input type="file" name="image">
                                <?php
                                  $bnr_img_db=!empty($drrdataeditdata[0]['image'])?$drrdataeditdata[0]['image']:'';
                                  if($bnr_img_db): ?>
                                    <img class="img-polaroid" src="<?php echo base_url("/uploads/project/".$bnr_img_db); ?>" style="width: 300px;height: 107px;">
                                    <input type="hidden" name="old_banner" value="<?php echo $bnr_img_db; ?>">
                                <?php endif;?>
                              <?=form_error('image')?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-sm-12">
                              <label class="control-label" for="bannerImg1">Enter Description </label>
                              <textarea  class="form-control ckeditor" rows="4" cols="50" name="description"><?php echo !empty($drrdataeditdata[0]['description'])?$drrdataeditdata[0]['description']:'' ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button style="margin-top: 10px;" type="submit" class="btn btn-info"><?php if($drrdataeditdata) { echo "Update";}else{echo "Submit";} ?></button>
                        </div>
                    </form>
                </div>
              </div>
          </section>
        </div>
      </div>
    </section>