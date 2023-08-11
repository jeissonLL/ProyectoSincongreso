<script>
    var resizefunc = [];
</script>

<!-- Main  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>

<!-- Custom main Js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Countdown -->
<script src="../plugins/countdown/dest/jquery.countdown.min.js"></script>
<script src="../plugins/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {

        // Countdown
        // To change date, simply edit: var endDate = "January 17, 2017 20:39:00";
        $(function () {
            var endDate = "January 17, 2018 20:39:00";
            $('.app-countdown .row').countdown({
                date: endDate,
                render: function (data) {
                    $(this.el).html('<div><div><span class="text-primary">' + (parseInt(this.leadingZeros(data.years, 2) * 365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span><b>Days</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.hours, 2) + '</span><span><b>Hours</b></span></div></div><div class=""><div><span class="text-primary">' + this.leadingZeros(data.min, 2) + '</span><span><b>Minutes</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.sec, 2) + '</span><span><b>Seconds</b></span></div></div>');
                }
            });
        });

        // Text rotate
        $(".home-text .rotate").textrotator({
            animation: "fade",
            speed: 3000
        });
    });

</script>


</body>
</html>
