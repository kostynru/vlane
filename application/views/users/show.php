<div class="row">
    <div class="span12">
        <h1><strong><center>Моя страница</strong></center></h1>
    </div>
</div>
<div class="row">
     <div class="span4">
         <img src="photo.jpg" alt="Здесь будет фото">
     </div>
     <div class="span8">
         <h2>
         <?php
         echo $user["name"];
         ?>
         </h2>
         <?php
         echo $user["city"];
         echo"<br>";
         echo $user["birthday"];
         echo"<br>";
         echo $user["school"];
         echo $group["name"];
         echo "(";
         echo $group["season_id"]
         ?>
     </div>
</div>
