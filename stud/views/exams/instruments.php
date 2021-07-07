<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $_SESSION['name'] = 'sasd';
?>
    
    
<style>
  body { background: url(template/images/in1.jpg); }
</style>
<?php foreach ($instrumentsList as $instrumentItem):?>
<a href = '/instruments/<?php echo $instrumentItem[$i]['instrument_id']?>'></a></br>
    
<?php endforeach;?>