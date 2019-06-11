<section id="main-content" class=""><style>.error{ color: red; }</style>
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           Publication File Type
            <form role="form"  method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo !empty($puddata[0]['id'])?$puddata[0]['id']:'' ?>">
                 <div class="form-group">
                  <div class="col-md-4">
                    <label for="exampleInputFile"> Select File category</label>
                  <select name="category" class="form-control">
                    <option value="">----- Select File category ------</option>
                    <?php // print_r($data['puddata']);die;
                    if($pub){ 
                        $dbcatid = !empty($puddata[0]['sub_cat_id'])?$puddata[0]['sub_cat_id']:'';
                        
                    foreach ($pub as $key => $value) {  ?>
                      <option value="<?php echo $value['id']  ?>" <?php if($dbcatid == $value['id']){ echo "Selected=Selected";}?>><?php echo $value['name'] ?></option>
                    <?php }  } ?>
                  </select>
                  <?php echo form_error('category'); ?>
                  </div>
                  <div class="col-md-4">
                    <label for="name">Publication File Type Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo !empty($puddata[0]['name'])?$puddata[0]['name']:'' ?>" placeholder="ENTER PUBLICATION CATEGORY NAME">
                    <?php echo form_error('name'); ?>
                  </div>
                    </div>  
              <div class="panel-body">
                <div class="position-center">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-info"><?php if($puddata) { echo "Update";}else{echo "Submit";} ?></button>
                  </div>
                  </div>
                </div>
                    </div>
                  </form>
                </div>
              </div>
            </header>
          </section>
        </div>

          <header class="panel-heading">
             <b><?php echo $this->lang->line('publications'); ?></b>
          </header>
          <div class="panel-body">
            <?php
              $error= $this->session->flashdata('msg');
               if($error){ ?>
                 <div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Message!!!!</strong>  <?php echo $error ; ?>
                      </div>
               <?php
               }
                ?>
            <?php  if($publicationdata == NULL){   ?>
              <h4> <?php echo $this->lang->line('nodata'); ?>  </h4>
            <?php }else{ ?>
              <table class="table table-hover" id="tb3">
                  <thead>
                  <tr>
                    <?php foreach($publicationdata[0] as $key => $value){


                                  ?>
                      <td>
                        <?php
                        $cleanname = explode("_", $key);
                        foreach ($cleanname as $r) {
                          echo ucfirst($r)." ";
                                        }?>
                      </td>
                    <?php  } ?>
                    <td>
                      <?php echo $this->lang->line('operation'); ?>
                    </td>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach($publicationdata as $v ){ ?>
                  <tr>
                      <?php foreach($v as $key => $value) {
                          ?>
                      <td><?php echo $value;?></td>
                    <?php }  ?>
                      <td>
                        <a href="<?php echo base_url(FOLDER_ADMIN)?>/publication/filecat?id=<?php echo base64_encode($v['id']);?>"><?php echo $this->lang->line('edit'); ?></a> /
                        <a onclick="return confirm('Are you sure you want to delete?')" href="<?php echo base_url(FOLDER_ADMIN)?>/publication/delete_filecat?id=<?php echo  $v['id'];?>"><?php echo $this->lang->line('delete'); ?></a></td>
                  </tr>
                <?php  }?>
                  </tbody>
              </table>
            <?php }?>
          </div>
        </div>
    </section>
</section>

