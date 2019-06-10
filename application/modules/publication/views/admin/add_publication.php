<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<section id="main-content" class="">
    <style>
        .error {
            color: red;
        }
    </style>
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
                            <div class="col-md-4">
                                <label for="exampleInputFile"> About Type </label>
                                <select name="category" class="form-control">
                                    <option value="">----- Select About------</option>
                                    <?php if($pub){
                                        foreach ($pub as $key=> $value){ ?>
                                        <option value="<?php echo $value['id'] ?>">
                                            <?php echo $value['name'] ?>
                                        </option>
                                        <?php } } ?>
                                </select>
                                <?php echo form_error('category'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">सिर्षक </label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-4" id="AudioUrl" >
                                <label for="exampleInputFile">About Video</label>
                                <input type="file" name="audio" id="exampleInputFile"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8" id="videoUrlData" >
                                <label for="exampleInputEmail1">Video Url</label>
                                <textarea class="form-control " name="videolink" rows="9" cols="50" placeholder="Enter Youtube Video Url Title"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4" id="ImageDiveSelector" >
                                <label class="control-label">About Photo </label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div> <span class="btn btn-white btn-file"> <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" name="proj_pic" class="default" /> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label">Summary</label>
                                <textarea class="form-control ckeditor" name="summary" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label" for="">&nbsp;&nbsp;&nbsp;</label>
                                <button type="submit" name="submit" class="btn btn-info" style="margin-top: 15px;">Submit</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>
