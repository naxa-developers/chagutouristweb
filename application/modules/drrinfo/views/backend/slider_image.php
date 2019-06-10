<section id="main-content">
    <section class="wrapper">
            <section class="panel">
                <header class="panel-heading">Drr related article </header>
                <form  method="POST" action=""  enctype="multipart/form-data" >
                    <input type="hidden" name="id" value="<?php echo !empty($hazard_id)?$hazard_id:'' ?>">
                    <div class="controls-field" id="b1">
                        <div class="row">
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="title">Title : </label>
                                    <input type="text" class="form-control"  id="title" name="title[]" value="<?php echo !empty($drreditdata[0]['title'])?$drreditdata[0]['title']:'' ?>" required >
                                     <?php echo form_error('title'); ?>  
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="short_summary">Short Summary : </label>
                                    <textarea class="form-control"  id="short_summary" name="short_summary[]" required><?php echo !empty($drreditdata[0]['short_summary'])?$drreditdata[0]['short_summary']:'' ?></textarea>
                                     <?php echo form_error('short_summary'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputFile">Hazard Slider Image</label>
                                    <input type="file" name="gly_path[]"  id="exampleInputFile">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="submit">&nbsp;&nbsp;</label><br>
                                    <button id="b1" class="btn btn-info add-more-gallery" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="submit">&nbsp;&nbsp;</label><br>
                        <button type="submit" name="submit" class="btn btn-primary"><?php if($drreditdata){ echo "Update";}else{ echo"Submit";} ?></button>
                    </div>
                </form>
            </section>
    </section>
</section>
<script type="text/javascript">
    $(document).off('click', '.add-more-gallery')
    $(document).on('click', '.add-more-gallery', function (e) {
        e.preventDefault();
        var count =$('div.controls-field').length;
        var addto = "#b" + count;
        next = count + 1;
        //var newIn = '<div class="controls-field" id="b'+next+'"><br /><label>Gallery Title '+next+'</label><input type="text" name="gly_title[]" value="" class="input-xlarge" placeholder="Enter Gallery title here" /><label>Gallery Content '+next+'</label><input type="text" name="gly_content[]" value="" class="input-xlarge" placeholder="Enter Gallery  Content here" /><label class="control-label">Image '+next+'</label><div class="input-append"><input type="file" name="gly_path[]"/></div></div>';
        var newIn ='<div class="controls-field" id="b'+next+'"><div class="row"><div class="col-md-3"> <div class="form-group"> <label for="title">Title : '+next+'</label> <input type="text" class="form-control" id="title" name="title[]" value="<?php echo !empty($drreditdata[0]['title'])?$drreditdata[0]['title']:'' ?>" required> <?php echo form_error('title'); ?> </div></div><div class="col-md-3"> <div class="form-group"> <label for="short_summary">Short Summary : '+next+'</label> <textarea class="form-control" id="short_summary" name="short_summary[]" required> <?php echo !empty($drreditdata[0]['short_summary'])?$drreditdata[0]['short_summary']:'' ?> </textarea> <?php echo form_error('short_summary'); ?> </div></div><div class="col-md-3"> <div class="form-group"> <label for="exampleInputFile">Hazard Slider Image '+next+'</label> <input type="file" name="gly_path[]" id="exampleInputFile"> </div></div><div class="col-md-3"> <div class="form-group"> <label for="submit">&nbsp;&nbsp;</label> <br><button id="b1" class="btn btn-info add-more-gallery" type="button">+</button></div></div></div></div>';
        var newInput = $(newIn);
        $(addto).after(newInput);
    });
</script>

