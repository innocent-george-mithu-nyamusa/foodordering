<div class="insert-post-ads1" style="margin-top:20px;">
</div>
</div>

</body>
<script>
    setInterval(function () {
        <?php
        global $db;
        $clientsReadyToCollectQuery = "SELECT id FROM food_orders WHERE status='active'";
        $clientsReadyToCollectStmt = $db->prepare($clientsReadyToCollectQuery);
        $clientsReadyToCollectStmt->execute();
        $clientsReadyToCollectStmt->store_result();
        $peopleInQue = $clientsReadyToCollectStmt->num_rows();
        global $peopleInQue;
        if($peopleInQue < 21) {
        ?>
        $("#que-message").html("Please proceed to collect your order..");
        // $(".cd-simple").attr("id", "cd-simple");
        <?php
        } else {
        ?>
        $("#que-message").html("Please wait to collect you Order until Que Slot is open");
        <?php
        }
        ?>
    }, 20000);
</script>

<script type="text/javascript">

    $(document).ready(function () {

        countdownMinutes = 15;
        timeStart = new Date().getTime();
        timeEnd = timeStart + countdownMinutes * 60 * 1000;

        $('#cd-simple').countdown(timeEnd, {precision: 1000, defer: true},).on("update.countdown", function (event) {

            var $this = $(this).html(event.strftime(''
                + '<div class="countdown">' +
                '<div class="clock-count-container">' +
                '<h3 class="clock-val text-center">%-H</h3>' +
                '</div>' +
                '</div>' +
                '<div class="countdown">' +
                '<div class="clock-count-container">' +
                '<h3 class="clock-val text-center">%-M</h3>' +
                '</div>' +
                '</div>' +
                '<div class="countdown">' +
                '<div class="clock-count-container">' +
                '<h3 class="clock-val text-center">%-S</h3>' +
                '</div>' +
                '</div>'));
        }).on("finish.countdown", function (event) {
            var $this = $(this).html("");
            <?php
                $updateStatusQuery = "UPDATE food_orders SET status='active' WHERE id=?";
                $updateStatusStmt = $db->prepare($updateStatusQuery);
                $updateStatusStmt->bind_param("i", $orderId);
                $updateStatusStmt->execute();
            ?>
        }).countdown("start");

        $('#cd-circle').countdown(timeEnd, function (event) {
                var $this = $(this).html(event.strftime(''
                    + '<div class="countdown">' +
                    '<div class="clock-count-container ">' +
                    '<h1 class="clock-val text-center">%-H</h1>' +
                    '</div>' +
                    '<h4 class="clock-text"> Hours </h4>' +
                    '</div>' +
                    '<div class="countdown align-content-center">' +
                    '<div class="clock-count-container center">' +
                    '<h1 class="clock-val text-center">%-M</h1>' +
                    '</div>' +
                    '<h4 class="clock-text"> Mins </h4>' +
                    '</div>' +
                    '<div class="countdown align-content-center">' +
                    '<div class="clock-count-container ">' +
                    '<h1 class="clock-val text-center">%-S</h1>' +
                    '</div>' +
                    '<h4 class="clock-text"> Sec </h4>' +
                    '</div>'));
            }
        );
    })
</script>
</html>

