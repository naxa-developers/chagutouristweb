<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
      crossorigin="" />
<section id="main-content" class="">
    <style>
        .error {
            color: red;
        }
    </style>
   <style>
html, body, #container, #map {
padding: 0;
margin: 0;
}
html, body, #map, #container {
height: 460px;
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
                            <div class="col-md-3">
                                <label for="exampleInputFile"> Select Location </label>
                                <select name="location" class="form-control">
                                    <option value="">----- Select About------</option>
                                    <?php if($destination){
                                        foreach ($destination as $key=> $value){ ?>
                                        <option value="<?php echo $value['id'] ?>">
                                            <?php echo $value['name'] ?>
                                        </option>
                                        <?php } } ?>
                                </select>
                                <?php echo form_error('location'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputFile"> Type </label>
                                <select name="type" class="form-control">
                                    <option value="">----- Select Type------</option>
                                    <?php if($pub){
                                        foreach ($pub as $key=> $value){ ?>
                                        <option value="<?php echo $value['id'] ?>">
                                            <?php echo $value['name'] ?>
                                        </option>
                                        <?php } } ?>
                                </select>
                                <?php echo form_error('type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">सिर्षक </label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">longitude </label>
                                <input type="text" name="longitude" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('longitude'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Sort Order </label>
                                <input type="text" name="sort_order" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('sort_order'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Latitude </label>
                                <input type="text" name="latitude" class="form-control" id="exampleInputEmail1" placeholder="Enter Latitude">
                                <?php echo form_error('latitude'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-md-3" id="AudioUrl" >
                                <label for="exampleInputFile">Location Audio</label>
                                <input type="file" name="audio" id="exampleInputFile"> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-md-3" id="videoUrl" >
                                <label for="exampleInputFile">Location Video</label>
                                <input type="file" name="video" id="exampleInputFile"> 
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
               <!--  <section class="main" id="mapid">
                    <div class="fixedfooter">
                      <a href="https://play.google.com/store/apps/details?id=org.light.collect.android&hl=en"><button class="maptopBtn" id="addlight" type="button">
                          <i class="fa fa-lightbulb">
                          </i>
                          <h4>sldkfhnksdfbsnjkd</h4>
                          <span>test</span>
                          <img class="bulb" src="<?php echo base_url()?>assets/frontend/image/light.svg" alt="">
                      </button></a>

                      <div class="question">
                          <h5> Latitude </h5>
                          <input class="darkInput" type='text' name='latitude' id='latitude' value=''  placeholder='Enter Your Latitude'
                           required>
                          <span class="error"> Latitude </span>
                          <h5> Longitude </h5>
                          <input class="darkInput" type='text' name='longitude' id='longitude' value=''  placeholder='Enter Your Longitude'
                              required>
                          <span class="error"> Longitude </span>
                        </div>
                  </div>
                </section> -->
            </div>
        </div>
    </section>
</section>
<!-- <form>
<label for="latitude">Latitude:</label>
<input id="latitude" type="text" />
<label for="longitude">Longitude:</label>
<input id="longitude" type="text" />
:: or, enter your own lat-long values and <input type="button" value="Jump there" onClick="updateLatLng(document.getElementById('latitude').value,document.getElementById('longitude').value,1)">
:: <a href="#" onclick="map.zoomOut(3, {animate:true})">zoom out</a> ::
:: <a href="#" onclick="map.zoomIn(3, {animate:true})">zoom in</a>
</form>
<div id="map"></div>
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script> <!-- Orginal: http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js -->
<script>
// var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
// attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
// });
// //remember last position
// var rememberLat = document.getElementById('latitude').value;
// var rememberLong = document.getElementById('longitude').value;
// if( !rememberLat || !rememberLong ) { rememberLat = 18.53; rememberLong = 73.85;}
// var map = new L.Map('map', {
// 'center': [rememberLat, rememberLong],
// 'zoom': 12,
// 'layers': [tileLayer]
// });
// var marker = L.marker([rememberLat, rememberLong],{
// draggable: true
// }).addTo(map);
// marker.on('dragend', function (e) {
// updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
// });
// map.on('click', function (e) {
// marker.setLatLng(e.latlng);
// updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
// });
// function updateLatLng(lat,lng,reverse) {
// if(reverse) {
// marker.setLatLng([lat,lng]);
// map.panTo([lat,lng]);
// } else {
// document.getElementById('latitude').value = marker.getLatLng().lat;
// document.getElementById('longitude').value = marker.getLatLng().lng;
// map.panTo([lat,lng]);
// }
// }
</script> 