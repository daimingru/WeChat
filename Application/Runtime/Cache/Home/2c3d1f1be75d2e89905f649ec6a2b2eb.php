<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title></title>
</head>
<body>
<script src="/Public/jquery.min.js"></script>
<script>
$.ajax({
    type: "POST",
    url: '/index.php?m=Home&c=WeChat&a=index',
    data: {orderId: 1,rejectionRemarks: 2},
    dataType: "json"
})
.done(function(json){
  console.log(json);
})
</script>
</body>
</html>