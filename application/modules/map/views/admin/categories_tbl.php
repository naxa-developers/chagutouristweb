<!--main content start-->
<script src="<?php echo base_url();?>assets/admin/js/jquery-1.10.2.min.js"></script>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="panel">
          <section class="panel">
            <header class="panel-heading">
              <?php echo $this->lang->line('categories'); ?>
              <span class="tools pull-right">
                <a href="<?php echo base_url(FOLDER_ADMIN)?>/map/create_categories"><button type="submit" name="upload_data" class="btn btn-danger" style="background-color: #1fb5ad;border-color: #1fb5ad;margin-top: -7px;"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_category'); ?></button></a>
               <!--  <a href="<?php echo base_url()?>admin_category?tbl=" target="_blank"><button type="submit" name="upload_data" class="btn btn-danger" style="background-color: #1fb5ad;border-color: #1fb5ad;margin-top: -7px;"><i class="fa fa-map-marker"></i> <?php echo $this->lang->line('view_in_map'); ?></button></a>
                <a href="change_order_caegory" target="_blank"><button type="submit" name="upload_data" class="btn btn-danger" style="background-color: #1fb5ad;border-color: #1fb5ad;margin-top: -7px;"><i class="fa fa-list"></i><?php echo $this->lang->line('change_order'); ?> </button></a> -->
                </span>
                <!-- <span class="tools pull-right">
                  <?php echo $this->lang->line('switch_language'); ?>
                  <a class="nav-link" href="<?php echo base_url(FOLDER_ADMIN);?>/map/categories_tbl"><img src="<?php echo base_url();?>assets/img/nep.png" height="15"></a>
                  <a class="nav-link" href="<?php echo base_url(FOLDER_ADMIN);?>/map/categories_tbl"><img src="<?php echo base_url();?>assets/img/uk.png" height="15"></a>
               </span> -->

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

                <h4> NO Data   </h4>

              <?php }else{ ?>
                <table class="table table-hover" id="tb3">
                  <thead>
                    <tr>
                    <!--  <td>Audio</td>
                     <td>Video</td>
                     <td>Three sixty Image</td> -->
                    <?php
                     foreach($data[0] as $key => $value){ ?>
                     <?php  if($key == 'summary_list'){   ?>
                      <td>Summary List</td>
                      <?php }elseif($key == 'marker_type'){?>
                      <?php }elseif($key == 'sub_col'){?>
                      <?php }elseif($key == 'category_photo'){?>
                      <?php }elseif($key == 'ordering'){?>
                      <?php }else{?>
                        <td>
                          <?php
                          $cleanname = explode("_", $key);
                          foreach ($cleanname as $r) {
                            echo ucfirst($r)." ";
                          } ?>
                        </td>
                      <?php  } } ?>
                      <td>
                        <?php echo $this->lang->line('operation'); ?>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($data as $v ){ //echo "<pre>";print_r($v);die;?>
                      <tr>
                        <!-- <td>
                          <span data-id="<?php echo $v['id']  ?>"  data-type="image"  data-title="Add Image" data-nid="<?php  echo $v['category_table']; ?>" class="btn btn-primary btn-xs popupModal">Add Images</span>
                        </td>
                        <td>
                          <span data-id="<?php echo $v['id']  ?>" data-type="threesixty" data-title="Three Sixty Images" data-nid="<?php  echo $v['category_table']; ?>" class="btn btn-primary btn-xs popupModal">Three Sixty Images</span>
                        </td>
                        <td>
                          <span data-id="<?php echo $v['id']  ?>" data-type="audio" data-title="Add Audio" data-nid="<?php  echo $v['category_table']; ?>" class="btn btn-primary btn-xs popupModal">Audio</span>
                        </td> -->
                       <!--  <td>
                          <span data-id="<?php echo $v['id']  ?>" data-type="video" data-title="Add Video" data-nid="<?php  echo $table; ?>" class="btn btn-primary btn-xs GenerateQrcode">Generate Rcode</span>
                          <span id="Message_<?php echo $v['id']  ?>"></span>
                        </td>
                        <td>
                          <span data-id="<?php echo $v['id']  ?>" data-type="video" data-title="Add Video" data-nid="<?php  echo $v['category_table']; ?>" class="btn btn-primary btn-xs popupModal">Video</span>
                        </td> -->
                          <?php foreach($v as $key => $value) { ?>
                              <td><?php echo $value;?></td>
                            <?php  } ?>

                              <td><a href="<?php echo base_url(FOLDER_ADMIN)?>/map/add_all_details?tbl=<?php echo base64_encode($v['category_table']);?>"><button type="submit" class="btn-sm btn-primary">Add Information</button></a></td>
                            <td><a href="<?php echo base_url(FOLDER_ADMIN)?>/map/data_tables?tbl_name=<?php echo base64_encode($v['sub_categories']);?>"><?php echo $this->lang->line('view'); ?></a> /
                              <a href="<?php echo base_url(FOLDER_ADMIN)?>/map/edit_categories?id=<?php echo base64_encode($v['id']);?>&& tbl=<?php echo base64_encode($v['category_table']);?>"><?php echo $this->lang->line('edit'); ?></a> /
                              <a onclick="return confirm('Are you sure you want to delete?')" href="<?php echo base_url(FOLDER_ADMIN)?>/map/delete_data?id=<?php echo  $v['id'];?>&& tbl=<?php echo ($tbl_name);?>&& cat_tbl=<?php echo $v['category_table']  ?>"><?php echo $this->lang->line('delete'); ?></a>
                            </td>
                        </tr>
                            <div class="modal fade" id="myModal<?php echo  $v['id'];?>" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change Status</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Choose Status.</p>

                                    <form action="" method="POST">
                                      <input type="text" name="id" value="<?php echo  $v['id'];?>" hidden>



                                    <br><br>
                                <button type="submit" name="submit" class="btn btn-danger"><?php echo $this->lang->line('change'); ?></button>
                              </form>

                                  </div>
                                  <div class="modal-footer">
                                  </div>
                                </div>

                              </div>
                            </div>

                        <?php  } ?>
                      </tbody>
                    </table>
                  <?php } ?>
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
<script>
//  $(document).ready(function() {
//     $('.default_switch').on('change', function() {
//         console.log($(this).is(':checked'));
//         var id = $(this).attr('id');
//         if ($(this).is(':checked')) {
//             console.log('checked');
//             var def = 1;
//             change_default(id, def)
//         } else {
//             console.log('not-checked');
//             var def = 0;
//             change_default(id, def)
//         }
//     });
//     $('.public_view').on('change', function() {
//         console.log($(this).is(':checked'));
//         var id = $(this).attr('id');
//         if ($(this).is(':checked')) {
//             console.log('checked');
//             var def = 1;
//             change_public_view(id, def)
//         } else {
//             console.log('not-checked');
//             var def = 0;
//             change_public_view(id, def)
//         }
//     });
//     $('.allow_download').on('change', function() {
//         console.log($(this).is(':checked'));
//         var id = $(this).attr('id');
//         console.log(id);
//         if ($(this).is(':checked')) {
//             console.log('checked');
//             var def = 1;
//             change_allow_download(id, def)
//         } else {
//             console.log('not-checked');
//             var def = 0;
//             change_allow_download(id, def)
//         }
//     });

//     function change_default(id, value) {
//         $.ajax({
//             type: "POST",
//             url: "<?php echo base_url(FOLDER_ADMIN) ?>/map/update_default?id=" + id + "&value=" + value,
//             success: function(jsons) {
//               console.log(jsons);
//                 data = jQuery.parseJSON(jsons); 
//                 $("#ChangeDefaultStatus_"+id).html(data.message);
//                 setTimeout(function(){
//                   $("#ChangeDefaultStatus_"+id).html('');
//                 },4000);
//             }
//         })
//     }

//     function change_public_view(id, value) {
//         $.ajax({
//             type: "POST",
//             url: "<?php echo base_url(FOLDER_ADMIN) ?>/map/update_public_view?id=" + id + "&value=" + value,
//             success: function(jsons) {
//               console.log(jsons);
//                 data = jQuery.parseJSON(jsons); 
//                 $("#Publicview_"+id).html(data.message);
//                 setTimeout(function(){
//                   $("#Publicview_"+id).html('');
//                 },4000);
//             }
//         })
//     }

//     function change_allow_download(id, value) {
//         $.ajax({
//             type: "POST",
//             url: "<?php echo base_url(FOLDER_ADMIN) ?>/map/update_download_allow?id=" + id + "&value=" + value,
//              success: function(jsons) {
//               console.log(jsons);
//                 data = jQuery.parseJSON(jsons); 
//                 $("#changeAllowDownload_"+id).html(data.message);
//                 setTimeout(function(){
//                   $("#changeAllowDownload_"+id).html('');
//                 },4000);
//             }
//         })
//     }
// })

</script>
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
      var urlaction="<?php echo base_url(FOLDER_ADMIN) ?>/map/add_images_category";
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
