<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading"> Basic Forms </header>
                    <?php $error=$this->session->flashdata('msg'); if($error){ ?>
                        <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Message</strong>
                            <?php echo $error ; ?>
                        </div>
                        <?php } ?>
                      <form role="form" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="col-md-3">
                            <?php if($categories): ?>
                            <?php $dbcatid = !empty($edit_data[0]['category_id'])?$edit_data[0]['category_id']:'' ?>
                            <label for="category_id">Select About Type : </label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="0">----Select About Type ----- </option>
                                <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?php echo $value['id'] ?>" <?php if($dbcatid == $value['id']){ echo "Selected=Selected";}?>><?php echo  $value['name']; ?></option>
                                <?php } ?>
                            <?=form_error('category_id')?>
                            </select>
                        <?php endif; ?>
                        </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                              <label for="exampleInputEmail1">Title In English</label>
                              <input type="text" name="title" value="<?php echo !empty($edit_data['title'])?$edit_data['title']:'' ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Title in English"> 
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                              <label for="exampleInputEmail1">Title Nepali</label>
                              <input type="text" name="title" value="<?php echo !empty($edit_data['title'])?$edit_data['title']:'' ?>" class="form-control" id="exampleInputEmail1"  placeholder="Enter Title in Nepali"> 
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                              <label for="exampleInputEmail1">Title Chinese</label>
                              <input type="text" name="title" value="<?php echo !empty($edit_data['title'])?$edit_data['title']:'' ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Title in Chinese"> 
                            </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4">
                                  <label class=" control-label">Summary In English</label>
                                  <textarea class="form-control ckeditor" name="summary" rows="10" required><?php echo !empty($edit_data['summary'])?$edit_data['summary']:'' ?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4">
                                  <label class=" control-label">Summary In Nepali</label>
                                  <textarea class="form-control ckeditor" name="summary" rows="10" required><?php echo !empty($edit_data['summary'])?$edit_data['summary']:'' ?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4">
                                  <label class=" control-label">Summary In Chinese</label>
                                  <textarea class="form-control ckeditor" name="summary" rows="10" required><?php echo !empty($edit_data['summary'])?$edit_data['summary']:'' ?></textarea>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group ">
                              <label class="control-label col-md-3">Publicaton Photo </label>
                              <div class="col-md-9">
                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <?php if($edit_data) { ?>
                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> 
                                      <img src="<?php echo $edit_data['photo']?>" alt="" /> </div>
                                  <?php } ?>
                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                      <div> <span class="btn btn-white btn-file"> <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                          <input type="file" name="proj_pic" class="default" /> </span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" name="submit" class="input-control btn btn-info">Submit</button>
                      </form>
                </section>
            </div>
        </div>
    </section>
</section>