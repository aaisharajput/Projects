<?php 
 
     require_once('../php/code.php');
    $u_id= $_SESSION['u_id'];

    $Obj=new clsHobbies();
     $count=$Obj->ShowUserHobby($u_id);

if(isset($_POST['submit'])){

    if(!empty($_POST['list'])) {

        foreach($_POST['list'] as $value){
           $result=$Obj->UserHobbies($u_id,$value);
        }
        header("Refresh:.1");
    }

}
?>

<?php if(!$count){  ?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalInterest" hidden>
  Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModalInterest">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $lang['txt97']; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
       <?php echo $lang['txt98']; ?>
     <form method="post"  onsubmit="return check();">
       <div class="container">
   <div class="row">
     <div class="col-md-6">
       <div class="page__section page__custom-settings">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Singing">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt99']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Dancing">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt100']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Advanture">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt101']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Spirituality">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt102']; ?></span>
        </span>
      </label><br><br>
      <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Trekking">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt103']; ?></span>
        </span>
      </label>
  </div>
     </div>
     <div class="col-md-6">
       <div class="page__section page__custom-settings">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Bike Riding">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt104']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Camping">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt105']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Movies">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt106']; ?></span>
        </span>
      </label><br><br>
       <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Pool Party">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt107']; ?></span>
        </span>
      </label><br><br>
      <label class="toggle">
        <input class="toggle__input" type="checkbox" name="list[]" value="Fair">
        <span class="toggle__label">
          <span class="toggle__text"><?php echo $lang['txt108']; ?></span>
        </span>
      </label>
  </div>
     </div>
   </div>
 </div>

 <button type="submit" name="submit" class="btn btn-success"><?php echo $lang['txt90']; ?></button>
 </form>
      </div>

    </div>
  </div>
</div>
<?php } ?>
<script type="text/javascript">
  $(document).ready(function() {
  $('#myModalInterest').modal('show');
});


function check(){
  flag=true;
  count=($(":checkbox:checked").length);
  if(count<3){
   flag=false;
  }
  return flag;
}


</script>

 
