<?php 
include("memberClass.php");
function printOptions($options, $parent, $level=0)
{

  foreach ($options as $opt)
    {
      if ($parent == $opt['parentId'])
       {
           $indent = str_repeat('---', $level); 
           echo "<option value='".$opt['memberId']."'>".$indent.$opt['name']."</option>";
           printOptions($options, $opt['memberId'], $level+1);
       }
             
    }
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>NadSoft Interview Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
  
  <style>
  </style>
 </head>
 <body>
  <br /><br />

  <div class="container" style="width:900px;">
   <h2 align="center">Member Treeview Multilevel</h2>
   <br /><br />
   <div id="treeview"></div>
   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Member</button> -->
     <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Member</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
<?php
$objMember = new Member;
$membersResult = $objMember->getParentMembers();
$allMembersResult = $objMember->getAllMembers();
?>    
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Member</h4>
  </div>
  <div class="modal-body">
  <form id="frmMember" method="post">
    <div class="form-group">     
<?php
echo "<select class='form-control' id='memberSelect' name='memberSelect'>\n" ;
// call function
  echo "<option value='0'>--Parent--</option>";

printOptions($allMembersResult,0,2);
echo "</select>\n";

?>
      <div class="form-group">
        <label for="email">Child:</label>
          <input type="text" class="form-control" id="childEntry">
      </div>
      <button type="button" id="btnsubmit" class="btn btn-default" >Submit</button>
  </form>
  </div>
 </div>
</div>
      
    </div>
  </div>
  </div>
 </body>
</html>

<script type="text/javascript">
$(document).ready(function(){
 $.ajax({ 
   url: "fetch.php",
   method:"POST",
   dataType: "json",       
   success: function(data)  
   {
  $('#treeview').treeview({data: data});
   }   
 });
 
$(".dropdown-menu li a").click(function(){
  
  $(".btn:first-child").html($(this).text()+' <span class="caret"></span>');
  
});


$("#btnsubmit").on('click', function() {
 
   
    var memberName = $("#childEntry").val();
    var parentId = $("#memberSelect").val();
    var parentName = $("#memberSelect").text();
   $.ajax({ 
     url: "insertMember.php?",
     type:"POST",
     data: { "name" : memberName ,"parentId" : parentId } ,
     success: function(data)  
     {
       //var lastValue = $('#memberSelect option:last-child').val();
        var opt = document.createElement("option");
        // Add an Option object to Drop Down/List Box
        document.getElementById("memberSelect").options.add(opt);
        // Assign text and value to Option object
        opt.text = memberName;
        opt.value = parentId;
        opt.setAttribute('selected','selected');
        //$("#memberSelect").selectpicker("refresh");
        alert(data);
     }   
   });

});

});
</script>