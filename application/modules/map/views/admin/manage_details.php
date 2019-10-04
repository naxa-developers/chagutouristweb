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
                      <b> ATTRACTION LAYER MANAGEMENT</b>
                      <span class="tools pull-right">
                       
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
                              <?php foreach($v as $key => $value) { //echo "<pre>"; print_r($value);die;
                                  ?>
                              <td><?php echo $value;?></td>
                            <?php }  ?>
                            <td>
                              <button class="btnprint" id="print-element<?php echo $v['id'] ?>"> Print Qr Code</button>
                            
                            <div id="content-to-print<?php echo $v['id'] ?>">
                                  Name : <?php echo $v['name'] ?>
                                  <img src="<?php echo $v['primary_image'] ?>" height='210px'><br>
                                  <img src="<?php echo $v['qr_code'] ?>">
                              </div>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>"  data-type="image"  data-title="Add Image" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Add Images</span>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>" data-type="threesixty" data-title="Three Sixty Images" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Three Sixty Images</span>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>" data-type="audio" data-title="Add Audio" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Audio</span>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>" data-type="video" data-title="Add Video" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs GenerateQrcode">Generate QRcode</span>
                              <span id="Message_<?php echo $v['id']  ?>"></span>
                            </td>
                            <td>
                              <span data-id="<?php echo $v['id']  ?>" data-type="video" data-title="Add Video" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs popupModal">Video</span>
                            </td>
                              <td>
                                <a href="<?php echo base_url(FOLDER_ADMIN)?>/map/editMapLayer?id=<?php echo base64_encode($v['id']);?>&& tbl=<?php echo base64_encode($table);?>"><?php echo $this->lang->line('edit'); ?></a> 
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
<?php if($data){ foreach($data as $v ){ ?>
  <script type="text/javascript">
    $("#print-element<?php echo $v['id'] ?>").click(function() {
         $("#content-to-print<?php echo $v['id'] ?>").printThis();
    });
  </script>
<?php } } ?>
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
  $(document).off('click','.GenerateQrcode');
  $(document).on('click','.GenerateQrcode', function(){ 
      event.preventDefault();
      var id = $(this).data('id');
      var title = $(this).data('title');
      var nid = $(this).data('nid');
      //$('.modal-title').html(title);
      //$('#myModal').modal('show');
      var action="<?php echo base_url(FOLDER_ADMIN) ?>/map/generateQrcode";
      $.ajax({
      type: "POST",
      url: action,
      dataType: 'html',
      data: {id:id,nid:nid},
      success: function(jsons)
      {
        data = jQuery.parseJSON(jsons); 
        if(data.status=='success'){
          $('#Message_'+id).html(data.message);
          setTimeout(function(){
            $('#Message_'+id).html("");
           }, 700);
        }
      }
    });
  });
</script>
