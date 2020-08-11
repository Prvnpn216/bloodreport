<?php $this->registerJsFile('../vendors/bower/gentelella/vendors/dropzone/dist/min/dropzone.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);?>
<div class="">
  <div class="page-title">
    <div class="title_right">
      <div class="col-md-5 col-sm-5   form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel">
        <div class="x_content">
          <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
          <form action="form_upload.html" class="dropzone"></form>
          <br />
          <br />
          <br />
          <br />
        </div>
      </div>
    </div>
  </div>
</div>