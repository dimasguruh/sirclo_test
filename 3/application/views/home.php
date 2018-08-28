 <!DOCTYPE html>
 <html>
 <head>
   <title>Maeke Weight Day CRUD</title>
 </head>
 <body>
  <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="../js/modal/css/contact.css">
 <link rel="stylesheet" type="text/css" href="../js/modal/css/demo.css">
 <link rel="stylesheet" type="text/css" href="../js/datepicker/datepicker3.css">
 <div class="panel-body">
    <table class="table table-bordered nowrap" id="tblData">
      <thead>
        <tr>
          <th>Number</th>
          <th>Date</th>
          <th>Max</th>
          <th>Min</th>
          <th>Variance</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="viewdt">
      </tbody>
        <tr>
          <td colspan="2"><center>Average</center></td>
          <?php
            foreach ($dt->result() as $row) {
          ?>
              <td><?php echo $row->avmax; ?></td>
              <td><?php echo $row->avmin; ?></td>
              <td><?php echo $row->avvar; ?></td>
          <?php
            }
          ?>
        </tr>
    </table>
    <button class="btn btn-primary btn-xs pull-right" onclick="actadd();">
      <i class="fa fa-plus"></i> Tambah Data Master 
    </button>     
</div>
<div id="inputmodal" class="modal container fade" data-width="760" data-backdrop="static" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
      &times;
    </button>
    <h4 class="modal-title">Add Data</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="inputform">
      <div class="form-group">
          <label class="col-md-2">
            <font color="white"> Date :</font> 
          </label>
          <div class="col-md-10"><input type="text" name="datepicker" id="datepicker" style="width: 15%"></div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
            <font color="white">  Weight Maximum : </font>
          </label>
          <div class="col-md-10"><input type="text" name="wmax" id="wmax" style="width: 25%"></div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
            <font color="white">  Weight Minimum : </font>
          </label>
          <div class="col-md-10"><input type="text" name="wmin" id="wmin" style="width: 25%"></div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" id="inputbtn" onclick="submit();">
      Save
    </button>
    <button type="button" data-dismiss="modal" class="btn btn-light-grey">
      Cancel
    </button>
  </div>
</div>
<div id="inputmodal2" class="modal container fade" data-width="760" data-backdrop="static" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
      &times;
    </button>
    <h4 class="modal-title">Edit Data</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="inputform2">
      <div class="form-group">
          <label class="col-md-2">
          <font color="white">  Date : </font>
          </label>
          <div class="col-md-10" id="dateplace"></div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
            <font color="white">  Weight Maximum : </font>
          </label>
          <div class="col-md-10" id="maxiplace"></div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
            <font color="white">  Weight Minimum : </font>
          </label>
          <div class="col-md-10" id="miniplace"></div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" id="inputbtn" onclick="submit2();">
      Save
    </button>
    <button type="button" data-dismiss="modal" class="btn btn-light-grey">
      Cancel
    </button>
  </div>
</div>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/modal/js/contact.js"></script>
<script type="text/javascript" src="../js/modal/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="../js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  function viewdt(){
    var numb = 1;
    var dt;
    $.ajax({
      url : "<?php echo base_url('Weight/show_data');?>",
      success : function(data){
        $.each(data, function(i,obj){
          var id = obj.id;
          var varianc = obj.maxi - obj.mini;
          dt = dt +"<tr><td>"+numb+"</td><td>"+obj.ddate+"</td><td>"+obj.maxi+"</td><td>"+obj.mini+"</td><td>"+varianc+"</td><td width = '300px'><center><button type='button' class='btn btn-success' onclick='actedit(\""+obj.id+"\");'>Edit</button>&nbsp;<button type='button' class='btn btn-danger' onclick='actdelete(\""+obj.id+"\");'>Delete</button>&nbsp;<button type='button' class='btn btn-primary' onclick='actshow(\""+obj.id+"\");'>Show</button></center></td></tr>";
          numb++;
        });
        $("#viewdt").html(dt);
      },
      dataType : 'JSON'
    });
  }
  function get_date(id){
    var dt;
    $.ajax({
      url : "<?php echo base_url('Weight/get_date/')?>"+id,
      success : function(data){
        $.each(data.row, function(i,obj){
          dt = dt+ '<input type="text" name="datepicker2" id="datepicker2" style="width: 15%" value="'+obj.ddate+'"><input type="hidden" id="idm" style="width: 15%" value="'+id+'">';
        });
        $("#dateplace").html(dt);
        $("#datepicker2").datepicker({
            autoclose: true,
            format:'yyyy-mm-dd'
          });
      },
      dataType : 'JSON'
    });  
  }
  function get_maxi(id){
    var dt;
    $.ajax({
      url : "<?php echo base_url('Weight/get_max/')?>"+id,
      success : function(data){
        $.each(data, function(i,obj){
          dt = dt+'<input type="text" name="wmax2" id="wmax2" style="width: 25%" value="'+obj.maxi+'">';
        });
        $("#maxiplace").html(dt);
      },
      dataType : 'JSON'
    });  
  }
  function get_mini(id){
    var dt;
    $.ajax({
      url : "<?php echo base_url('Weight/get_min/')?>"+id,
      success : function(data){
        $.each(data, function(i,obj){
          dt = dt+'<input type="text" name="wmin2" id="wmin2" style="width: 25%" value="'+obj.mini+'">';
        });
        $("#miniplace").html(dt);
      },
      dataType : 'JSON'
    });  
  }
  function actadd(){
    $('#inputmodal').modal();
  }
  function actedit(id){
      $('#inputmodal2').modal();
      get_date(id);
      get_maxi(id);
      get_mini(id);
  }
  function actshow(id){
    window.location.href = "<?php echo base_url('Weight/show/')?>"+id
  }
 $("#datepicker").datepicker({
        autoclose: true,
        format:'yyyy-mm-dd'
      });
  function submit(){
    $.ajax({
      method : 'POST',
      data : $("#inputform").serialize(),
      url : "<?php echo base_url('Weight/submit'); ?>",
      success : function(id){
        alert("Add Data Success");
        $('#inputmodal').modal('toggle');
              document.getElementById("inputform").reset();
              location.reload();
      }
    })
  }
  function submit2(){
    var id = $("#idm").val();
    $.ajax({
      method : 'POST',
      data : $("#inputform2").serialize(),
      url : "<?php echo base_url('Weight/submit2/'); ?>"+id,
      success : function(id){
        alert("Edit Data Success");
        $('#inputmodal2').modal('toggle');
              document.getElementById("inputform2").reset();
              location.reload();
      }
    })
  }
  function actdelete(id){
        var x = confirm("Are You Sure To Delete Data?")
        if(x){
             $.ajax({
              method : 'POST',
              url : "<?php echo base_url('Weight/delete/'); ?>"+id,
              success : function(id){
                alert("Delete Data Success");
                  location.reload();
              }
            });  
        }else{
          return false;
        }
  }

  viewdt();
</script>
 </body>
 </html>