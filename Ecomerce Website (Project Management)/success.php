<html style="background-color:#F4F4F4;">
<body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
swal("Payment Confirmed!", "A Copy Of Invoice Will Be Mailed To You!", "success").then(function() {
    window.location = "invoice_generated.php";
});
</script>
</body>
</html>