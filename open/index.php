<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>فتح العقار</title>
  <script>
    function openApp() {
      window.location = "abaad://<?php echo $id; ?>";
    }
  </script>
</head>
<body style="text-align:center;margin-top:100px;font-family:Arial;">

  <h2>فتح العقار</h2>

  <button onclick="openApp()" 
    style="padding:15px 25px;font-size:18px;background:#007bff;color:white;border:none;border-radius:8px;">
    فتح في التطبيق
  </button>

  <br><br>

  <a href="/details/<?php echo $id; ?>">
    عرض في الويب
  </a>

</body>
</html>