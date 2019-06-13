<section id="main-content">
    <section class="wrapper">
        <div class="row">
          <div class="col-sm-12">
              <section class="panel">
                <section class="panel">
                    <header class="panel-heading">
                       <b><?php echo $this->lang->line('location'); ?></b>
                        <span class="tools pull-right">
                          <a href="<?php echo base_url(FOLDER_ADMIN)?>/location/add_location"><button type="submit" name="upload_data" class="btn btn-danger" style="background-color: #1fb5ad;border-color: #1fb5ad;margin-top: -7px;"><i class="fa fa-plus"></i><?php echo $this->lang->line('locationadd'); ?></button></a>
                         </span>
                    </header>
                    <div class="panel-body">
                      <?php
                        $error=	$this->session->flashdata('msg');
                         if($error){ ?>
                           <div class="alert alert-info alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Message!!!!</strong>  <?php echo $error ; ?>
                                </div>
                         <?php
                         }
                          ?>
                      <?php  if($data == NULL){   ?>
                        <h4> <?php echo $this->lang->line('nodata'); ?>  </h4>
                      <?php }else{ ?>
                        <table class="table table-hover" id="tb3">
                            <thead>
                            <tr>
                              <?php foreach($data[0] as $key => $value){


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
                            <?php foreach($data as $v ){ //echo "<pre>"; print_r($data);die; ?>
                            <tr>
                            <td><?php echo $v['id'] ?></td>
                              <td><?php echo $v['description'] ?></td>
                              <td><?php echo $v['created_at'] ?></td>
                              <td>
                              <button class="btnprint" id="print-element<?php echo $v['id'] ?>"> Print Barcode </button>
                             
                              </td>
                              <td><?php echo $v['language'] ?></td>
                              <td>
                                <audio controls >
                                    <source src="<?php echo $v['audio'] ?>" type="<?php echo $v['audio'] ?>">
                                    <source src="<?php echo $v['audio'] ?>" type="<?php echo $v['audio'] ?>">
                                  Your browser does not support the audio element.
                                  </audio>
                              
                              </td>
                              <td>
                              <video width="150" controls>
                                <source src=" <?php echo $v['video'] ?>" type="video/mp4">
                                <source src="<?php echo $v['video'] ?>" type="video/ogg">
                                Your browser does not support HTML5 video.
                              </video>
                             
                              </td>
                              <td><?php echo $v['sort_order'] ?></td>
                              <td><?php echo $v['rating'] ?></td>
                              <td><?php echo $v['longitude'] ?></td>
                              <td><?php echo $v['latitude'] ?></td>
                              <td> 
                                <div id="content-to-print<?php echo $v['id'] ?>">
                                    <img src="<?php echo $v['qrcode'] ?>">
                                </div>
                              </td>
                              <td>
                                  <a class="btn btn-primary btn-sm" href="<?php echo base_url(FOLDER_ADMIN)?>/location/edit_publication?id=<?php echo base64_encode($v['id']);?>"><?php echo $this->lang->line('edit'); ?></a> /
                                  <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="<?php echo base_url(FOLDER_ADMIN)?>/location/delete_publication?id=<?php echo  $v['id'];?>"><?php echo $this->lang->line('delete'); ?></a>
                              </td>
                            </tr>
                          <?php  } ?>
                            </tbody>
                        </table>
                      <?php } ?>
                    </div>
                </section>
              </section>
          </div>
       </div>
    </section>
</section>
<?php foreach($data as $v ){ ?>
  <script type="text/javascript">
    $("#print-element<?php echo $v['id'] ?>").click(function() {
         $("#content-to-print<?php echo $v['id'] ?>").printThis();
    });
  </script>
<?php } ?>
