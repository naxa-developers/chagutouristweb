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
                    <header class="panel-heading"> Map Data Edit </header>
                    <form role="form" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Title </label>
                                <input type="text" name="a1" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php  echo $chaangesmapdata[0]['a1']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label">Description</label>
                                <textarea class="form-control ckeditor" name="a3" rows="10"><?php  echo $chaangesmapdata[0]['a3'] ?></textarea>
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
