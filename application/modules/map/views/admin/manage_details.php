<!--main content start-->
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<section id="main-content">
    <section class="wrapper">
    <!-- page start-->
        <div class="row">
        <div class="col-sm-12">
            <section class="panel">
              <section class="panel">
                  <header class="panel-heading">
                      <b> <?php echo $this->lang->line('project_partners'); ?></b>
                      <span class="tools pull-right">
                        <a href="<?php echo base_url()?>add_proj"><button type="submit" name="upload_data" class="btn btn-danger" style="background-color: #1fb5ad;border-color: #1fb5ad;margin-top: -7px;"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_project_partners'); ?></button></a>
                       </span>
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
                    <?php  if($data == NULL){   ?>

                      <h4><?php echo $this->lang->line('nodata'); ?> </h4>

                    <?php }else{ ?>
                      <table class="table table-hover" id='tb1'>
                          <thead>
                          <tr>
                            <?php foreach($data[0] as $key => $value){ ?>
                              <td>

                                <?php

                                $cleanname = explode("_", $key);
                                foreach ($cleanname as $r) {
                                  echo ucfirst($r)." ";
                                                }?>

                              </td>
                              
                            <?php  } ?>
                            <td>Image</td>
                            <td>
                              <?php echo $this->lang->line('operation'); ?>
                            </td>
                          </tr>
                          </thead>
                          <tbody>
                              <?php foreach($data as $v ){ ?>
                          <tr>
                              <?php foreach($v as $key => $value) {
                                  ?>
                              <td><?php echo $value;?></td>
                            <?php }  ?>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>"  data-type="image"  data-title="Add Image" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Add Images</span>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>" data-type="threesixty" data-title="Three Sixty Images" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Three Sixty Images</span>
                            </td>
                              <td>
                              <a href="" >Add Images</a>
                                <!-- <a href="<?php echo base_url()?>proj/edit_proj?id=<?php echo base64_encode($value['id']);?>&& tbl=<?php echo base64_encode($value['id']);?>"><?php echo $this->lang->line('edit'); ?></a> --> 
                                </td>
                          </tr>
                        <?php  }?>
                          </tbody>
                      </table>
                    <?php }?>
                  </div>
              </section>
            </section>
        </div>
    </div>
  </div>
    <!-- page end-->
    </section>
</section>
<!--main content end-->
<script type="text/javascript">
  $(document).off('click','.popupModal');
  $(document).on('click','.popupModal',function(e)
  {
    var id = $(this).data('id');
    var nid = $(this).data('nid');
    var title = $(this).data('title');
    var type = $(this).data('type');
    $('.modal-title').html(title);
    $('#myModal').modal('show');
    var action="<?php echo base_url(FOLDER_ADMIN) ?>/map/add_images";
    $.ajax({
    type: "POST",
    url: action,
    dataType: 'html',
        data: {id:id,nid:nid,type:type},
        success: function(jsons)
        {
         data = jQuery.parseJSON(jsons); 
          if(data.status=='success'){
            console.log(data.template);
            $('#finalDataShow').html(data.template);
            // setTimeout(function(){
            // window.location.href = url;
            //  }, 500);
          }
      }
    });
  });
  $(document).off('click','.submitCompany');
  $(document).on('click','.submitCompany', function(){ 
      event.preventDefault();
      var formdata = new FormData($('form#imagesMoreAdd')[0]);
      //var formdata = new FormData($(this)[0]);
      var urlaction="<?php echo base_url(FOLDER_ADMIN) ?>/map/add_images_tomap";
      console.log(formdata);
      jQuery.ajax({
        type: "POST",
        url: urlaction,
        data: formdata,
        //dataType: "json",
        processData: false,
        contentType: false,
        cache: false,
         headers: { 'X-Requested-With': 'XMLHttpRequest' },
          success:function(jsons){
            console.log(jsons);
            data = jQuery.parseJSON(jsons); 
            if(data.status=='success')
            {
              $('#GlobalModalFormMessage').html(data.message);
              setTimeout(function(){
                  $('#imagesMoreAdd')[0].reset();
                  $('#myModal').modal('hide');
              },2000);
            }
          }
     });
  });
</script>
